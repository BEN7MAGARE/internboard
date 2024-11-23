<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Application;
use App\Models\Category;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->category = new Category();
        $this->job = new Job();
        $this->skill = new Skill();
        $this->application = new Application();
    }


    public function index()
    {
        $query = $this->job->query();

        if (auth()->check() && (auth()->user()->role === "student" || auth()->user()->role === "worker")) {
            $skills = auth()->user()->skills->pluck('id'); // Fetch user's skills IDs
            if ($skills->isNotEmpty()) { // Check if the user has any skills
                $query->whereHas('skills', function ($q) use ($skills) {
                    $q->whereIn('skills.id', $skills); // Match jobs with the user's skills
                });
            }
        }

        $jobs = $query->latest()->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function categories()
    {
        $categories = $this->category->latest()->get();
        return json_encode($categories);
    }

    public function skills()
    {
        $skills = $this->skill->get();
        return json_encode($skills);
    }

    public function create()
    {
        if (auth()->user()->role === "corporate") {
            return view('jobs.create');
        } else {
            return redirect()->back()->withErrors(['error' => 'You must own a corporate account to post jobs']);
        }
    }


    public function store(JobRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        $job = $this->job->create(['ref_no' => strtoupper(Str::random(3)) . strtotime(now())] + $validated);
        foreach (explode(',', json_decode($validated["skills"], true)) as $value) {
            DB::table('job_skill')->insert(['job_id' => $job->id, 'skill_id' => $value]);
        }
        DB::commit();
        return json_encode(['status' => 'success', 'message' => 'Job post added successfully']);
    }

    public function show(string $id)
    {
        $job = $this->job->find($id);
        return json_encode($job);
    }

    public function jobs()
    {
        $jobs = $this->job->latest()->get();
        return json_encode($jobs);
    }

    public function apply($ref_no)
    {
        if (auth()->user()->role === "student" || auth()->user()->role === "worker") {
            $job = $this->job->where('ref_no', $ref_no)->orWhere('id', $ref_no)->with('corporate')->first();
            $application = $this->application->where('job_id', $job->id)->where('user_id', auth()->id())->first();
            $applied = false;
            if (!is_null($application)) {
                $applied = true;
            }
            return view('jobs.apply', compact('job', 'applied'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource.');
        }
    }

    public function applicationCreate(Request $request)
    {
        $validated = $request->validate([
            'job_id' => ['required', 'exists:jobs,id'],
            'reason' => ['required', 'string'],
            'cover_letter' => ['required', 'max:1000'],
            'curriculum_vitae' => ['nullable', 'max:2000'],
            'files' => ['nullable'],
        ]);
        $application = $this->application->where('user_id', auth()->id())->where('job_id', $validated["job_id"])->first();
        if (!is_null($application)) {
            return json_encode(['status' => 'success', 'message' => "You have already applied for this job. Thank you"]);
        }
        $job = $this->job->find($validated["job_id"]);
        $filename = "";
        if ($request->hasFile('curriculum_vitae')) {
            $filename .= 'CV' . auth()->id() . $job->ref_no . strtotime(now()) . '.' . $request->file('curriculum_vitae')->getClientOriginalExtension();
            $request->file('curriculum_vitae')->storeAs('applicant_resources/', $filename);
        }
        $fileNames = [];
        if (isset($request->files)) {
            foreach ($request->file('files') as $file) {
                $fileName = auth()->id() . $job->ref_no . strtotime(now()) . '.' . $file->getClientOriginalExtension(); // or any other desired file name
                $file->move('applicant_resources/', $fileName);
                array_push($fileNames, $fileName);
            }
        }
        $application = new Application();
        $application->user_id = auth()->id();
        $application->job_id = $validated['job_id'];
        $application->reason = $validated['reason'];
        $application->cover_letter = $validated['cover_letter'];
        $application->curriculum_vitae = $filename;
        $application->files = json_encode($fileNames);
        $application->status = "pending";
        $application->save();

        return json_encode(['status' => 'success', 'message' => 'Job application saved successfully']);
    }

    public function applications($job_id)
    {
        $job = $this->job->with('applications.applicant.profile')->withCount('applications')->find($job_id);
        if ($job->corporate_id == auth()->user()->corporate_id) {
            return view('profile.applicants', compact('job'));
        } else {
            abort(405, 'You are not authorised to access this resource');
        }
    }

    public function jobsLocations()
    {
        $locations = $this->job->select('location')->distinct()->pluck('location');
        return $locations;
    }

    public function search(Request $request)
    {
        $params = $request->all();
        $experienceLevels = json_decode($params['experience_level'], true);
        $educationLevels = json_decode($params['education_level'], true);
        $locations = collect(json_decode($params['location'], true))->filter(fn($value) => is_string($value))->values();
        $query = $this->job->query();
        if (!empty($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }
        if (!empty($params['employment_type'])) {
            $query->where('employment_type', $params['employment_type']);
        }
        if (!empty($params['job_type'])) {
            $query->where('job_type', $params['job_type']);
        }
        if (!empty($experienceLevels)) {
            $query->whereIn('experience_level', $experienceLevels);
        }
        if (!empty($educationLevels)) {
            $query->whereIn('education_level', $educationLevels);
        }
        if ($locations->isNotEmpty()) {
            $query->whereIn('location', $locations->toArray());
        }
        $jobs = $query->get();
        return response()->json($jobs);
    }
}
