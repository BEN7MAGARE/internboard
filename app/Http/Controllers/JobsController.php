<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Application;
use App\Models\Category;
use App\Models\Corporate;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('categories', 'search', 'jsonSearch', 'skills', 'categoriesWithJobs', 'index', 'jobsLocations', 'show');
        $this->category = new Category();
        $this->job = new Job();
        $this->skill = new Skill();
        $this->application = new Application();
        $this->subCategory = new Subcategory();
        $this->corporate = new Corporate();
    }

    public function index()
    {
        $query = $this->job->query()->where('approved', true);
        if (auth()->check() && (auth()->user()->role === 'student' || auth()->user()->role === 'worker')) {
            $skills = auth()->user()->skills->pluck('id');
            if ($skills->isNotEmpty()) {
                $query->whereHas('skills', function ($q) use ($skills) {
                    $q->whereIn('skills.id', $skills);
                });
            }
        }
        $jobs = $query->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function categories()
    {
        $categories = $this->category->select('id', 'name')->latest()->get();
        return json_encode($categories);
    }

    public function categoriesWithJobs()
    {
        $categories = $this->category->whereHas('jobs')->limit(8)->get();
        return json_encode($categories);
    }

    public function skills()
    {
        $skills = $this->skill->get();
        return json_encode($skills);
    }

    public function create()
    {
        if (auth()->user()->role === 'corporate') {
            return view('jobs.create');
        } else {
            return redirect()->back()->withErrors(['error' => 'You must own a corporate account to post jobs']);
        }
    }

    public function store(JobRequest $request)
    {
        $validated = $request->validated();
        if (auth()->user()->role === 'corporate') {
            $validated['corporate_id'] = auth()->user()->corporate_id;
        }
        DB::beginTransaction();
        if ($validated['id'] === null || $validated['id'] === '') {
            $job = $this->job->create(['ref_no' => strtoupper(Str::random(3)) . strtotime(now())] + $validated);
            $message = 'Job post added successfully';
        } else {
            $job = $this->job->find($validated['id'])->update($validated);
            $message = 'Job post updated successfully';
        }
        if (isset($validated['skills'])) {
            foreach (explode(',', json_decode($validated['skills'], true)) as $value) {
                DB::table('job_skill')->insert(['job_id' => $job->id, 'skill_id' => $value]);
            }
        }
        DB::commit();
        return json_encode(['status' => 'success', 'message' => $message]);
    }

    public function show(string $ref_no)
    {
        $job = $this->job->where('ref_no', $ref_no)->orWhere('id', $ref_no)->first();
        $corporate = $this->corporate->where('id', $job->corporate_id)->withCount('jobs')->first();
        return view('jobs.show', compact('job', 'corporate'));
    }

    public function edit($ref_no)
    {
        $categories = $this->category->get();
        $job = $this->job->where('ref_no', $ref_no)->orWhere('id', $ref_no)->first();
        $subCategories = $this->subCategory->get();
        $skills = $this->skill->get();
        return view('employer.jobs.edit', compact('job', 'categories', 'subCategories', 'skills'));
    }

    public function jobs()
    {
        $jobs = $this->job->latest()->get();
        return json_encode($jobs);
    }

    public function apply($ref_no)
    {
        if (auth()->user()->role === 'student' || auth()->user()->role === 'worker') {
            $job = $this->job->where('ref_no', $ref_no)->orWhere('id', $ref_no)->with('corporate')->first();
            $application = $this->application->where('job_id', $job->id)->where('user_id', auth()->id())->first();
            $applied = false;
            if (!is_null($application)) {
                $applied = true;
            }
            return view('jobs.apply', compact('job', 'applied'));
        } else {
            return redirect('/')->with('errors', 'You are not authorised to access this resource.');
        }
    }

    public function applicationCreate(Request $request)
    {
        $validated = $request->validate([
            'job_id' => ['required', 'exists:jobs,id'],
            'preferred_pay' => ['required', 'string'],
            'reason' => ['required', 'string'],
            'cover_letter' => ['required', 'max:1000'],
            'curriculum_vitae' => ['nullable', 'max:2000'],
            'files' => ['nullable'],
        ]);
        $application = $this->application->where('user_id', auth()->id())->where('job_id', $validated['job_id'])->first();
        if (!is_null($application)) {
            return json_encode(['status' => 'success', 'message' => 'You have already applied for this job. Thank you']);
        }
        $job = $this->job->find($validated['job_id']);
        $filename = '';
        if ($request->hasFile('curriculum_vitae')) {
            $filename .= 'CV' . auth()->id() . $job->ref_no . strtotime(now()) . '.' . $request->file('curriculum_vitae')->getClientOriginalExtension();
            $request->file('curriculum_vitae')->move('applicant_resources/', $filename);
        }
        $fileNames = [];
        if (isset($request->files)) {
            foreach ($request->file('files') as $file) {
                $fileName = auth()->id() . $job->ref_no . strtotime(now()) . '.' . $file->getClientOriginalExtension();  // or any other desired file name
                $file->move('applicant_resources/', $fileName);
                array_push($fileNames, $fileName);
            }
        }
        $application = new Application();
        $application->user_id = auth()->id();
        $application->job_id = $validated['job_id'];
        $application->preferred_pay = $validated['preferred_pay'];
        $application->reason = $validated['reason'];
        $application->cover_letter = $validated['cover_letter'];
        $application->curriculum_vitae = $filename;
        $application->files = json_encode($fileNames);
        $application->status = 'pending';
        $application->save();
        return json_encode(['status' => 'success', 'message' => 'Job application saved successfully']);
    }

    public function applications($ref_no)
    {
        $job = $this->job->with('applications.applicant.profile')->withCount('applications')->where('ref_no', $ref_no)->first();
        if ($job->corporate_id == auth()->user()->corporate_id) {
            return view('jobs.applicants', compact('job'));
        } else {
            abort(405, 'You are not authorised to access this resource');
        }
    }

    public function applicationsDetails($id)
    {
        $application = $this->application->with('applicant.profile')->where('id', $id)->first();
        return json_encode($application);
    }

    public function jobsLocations()
    {
        $locations = $this->job->where('approved', true)->select('location')->distinct()->pluck('location');
        return $locations;
    }

    public function search(Request $request)
    {
        $params = $request->all();
        $experienceLevels = isset($params['experience_level']) && $params['experience_level'] !== null ? json_decode($params['experience_level'], true) : [];
        $educationLevels = isset($params['education_level']) && $params['education_level'] !== null ? json_decode($params['education_level'], true) : [];
        $locations = isset($params['location']) ? json_decode($params['location'], true) : [];
        $query = $this->job->query()->where('approved', true);
        if (!empty($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }
        if (!empty($params['employment_type'])) {
            $query->where('type', $params['employment_type']);
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
        if (!empty($locations)) {
            $query->whereIn('location', $locations);
        }
        $jobs = $query->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function jsonSearch(Request $request)
    {
        $params = $request->all();
        $experienceLevels = isset($params['experience_level']) && $params['experience_level'] !== null ? json_decode($params['experience_level'], true) : [];
        $educationLevels = isset($params['education_level']) && $params['education_level'] !== null ? json_decode($params['education_level'], true) : [];
        $locations = isset($params['location']) ? json_decode($params['location'], true) : [];
        $query = $this->job->query()->where('approved', true);
        if (isset($params['corporate_id']) && $params['corporate_id'] !== null) {
            $query->where('corporate_id', $params['corporate_id']);
        }
        if (isset($params['category_id']) && $params['category_id'] !== null) {
            $query->where('category_id', $params['category_id']);
        }
        if (isset($params['employment_type']) && $params['employment_type'] !== null) {
            $query->where('type', $params['employment_type']);
        }
        if (isset($params['job_type']) && $params['job_type'] !== null) {
            $query->where('job_type', $params['job_type']);
        }
        if (!empty($experienceLevels)) {
            $query->whereIn('experience_level', $experienceLevels);
        }
        if (!empty($educationLevels)) {
            $query->whereIn('education_level', $educationLevels);
        }
        if (!empty($locations)) {
            $query->whereIn('location', $locations);
        }
        $jobs = $query->with('corporate')->get();
        return response()->json($jobs);
    }

    public function approve(Request $request)
    {
        $ids = $request->input('ids');
        $jobs = $this->job->whereIn('id', $ids)->get();
        foreach ($jobs as $job) {
            $job->update(['approved' => true]);
        }
        return json_encode(['status' => 'success', 'message' => 'Jobs approved successfully.']);
    }
}
