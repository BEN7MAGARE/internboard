<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCorporateRequest;
use App\Models\Application;
use App\Models\Category;
use App\Models\Corporate;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('employer');
        $this->job = new Job();
    }
    public function profile()
    {
        if (auth()->user()->corporate) {
            $jobscount = auth()->user()->corporate->jobs()->count();
            $applicationscount = Application::whereHas('job', function ($query) {
                $query->where('corporate_id', auth()->user()->corporate_id);
            })->count();
            $employedcount = Application::whereHas('job', function ($query) {
                $query->where('corporate_id', auth()->user()->corporate_id);
            })->where('status', 'employed')->count();
            return view('employer.profile', [
                'user' => auth()->user(),
                'jobscount' => $jobscount,
                'applicationscount' => $applicationscount,
                'employedcount' => $employedcount,
            ]);
        } else {
            return redirect()->route('employer.create');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->corporate) {
            $jobscount = auth()->user()->corporate->jobs()->count();
            $applicationscount = Application::whereHas('job', function ($query) {
                $query->where('corporate_id', auth()->user()->corporate_id);
            })->count();
            $employedcount = Application::whereHas('job', function ($query) {
                $query->where('corporate_id', auth()->user()->corporate_id);
            })->where('status', 'employed')->count();
            return view('employer.profile', [
                'user' => auth()->user(),
                'jobscount' => $jobscount,
                'applicationscount' => $applicationscount,
                'employedcount' => $employedcount,
            ]);
        } else {
            return redirect()->route('employer.create');
        }
    }

    public function applications()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('corporate_id', auth()->user()->corporate_id);
        })->with(['job', 'applicant:id,first_name,last_name,phone,email'])->paginate(10);
        $jobs = $this->job->where('corporate_id', auth()->user()->corporate->id)->get();
        return view('employer.applications.index', compact('applications', 'jobs'));
    }

    public function jobApplications($ref_no)
    {
        $job = $this->job->with('applications.applicant.profile')->withCount('applications')->where('ref_no',
        $ref_no)->first();
        if ($job->corporate_id == auth()->user()->corporate_id) {
        return view('jobs.applicants', compact('job'));
        } else {
        abort(405, 'You are not authorised to access this resource');
        }
    }

    public function jobs()
    {
        if (auth()->user()->role === 'corporate') {
            $jobs = $this->job->where('corporate_id',
                auth()->user()->corporate_id)->withCount('applications')->latest()->paginate(10);
            return view('employer.jobs.index', compact('jobs'));
        } else {
            return redirect()->route('profile.edit');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        if (auth()->user()->role === 'corporate') {
            return view('employer.create', compact('categories'));
        } else {
            return redirect('profile');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCorporateRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('corporate_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        if ($validated['id'] !== null) {
            $corporate = Corporate::findOrFail($validated['id']);
            $corporate->update($validated);
            $message = 'Corporate updated successfully.';
        } else {
            $corporate = Corporate::create($validated);
            if (auth()->user()->role === 'corporate') {
                User::where('id', auth()->user()->id)->update(['corporate_id' => $corporate->id]);
            }
            $message = 'Corporate created successfully.';
        }
        DB::commit();

        return json_encode(['status' => 'success', 'message' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        return json_encode($corporate);
    }

    public function contactDetail(string $id)
    {
        $contact = User::findOrFail($id);
        return json_encode($contact);
    }

    public function contactShow(string $id)
    {
        $contact = User::findOrFail($id);
        return view('employer.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        return json_encode($corporate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCorporateRequest $request, string $id)
    {
        DB::beginTransaction();
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('corporate_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        $corporate = Corporate::findOrFail($id);
        $corporate->update($validated);
        DB::commit();

        return json_encode(['status' => 'success', 'message' => 'Business updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        $corporate->delete();
        return json_encode(['status' => 'success', 'message' => 'Business deleted successfully.']);
    }

    public function getCorporates()
    {
        $corporates = Corporate::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->get(['id', 'name']);
        return json_encode($corporates);
    }

    public function handleCorporate(StoreCorporateRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('corporate_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        $corporate = Corporate::create($validated);
        User::where('id', auth()->user()->id)->update(['corporate_id' => $corporate->id]);
        DB::commit();

        return json_encode(['status' => 'success', 'message' => 'Business created successfully.']);
    }

    public function contacts()
    {
        $contacts = User::where('role', 'corporate')->where('corporate_id', auth()->user()->corporate_id)->paginate(10);
        return view('employer.contacts.index', compact('contacts'));
    }

    public function contactDelete(string $id)
    {
        $contact = User::findOrFail($id);
        $contact->delete();
        return json_encode(['status' => 'success', 'message' => 'Contact deleted successfully.']);
    }

    public function deleteJob($id)
    {
        $job = Job::find($id)->delete();
        return response()->json(["status"=>"success", "message"=>"Job deleted successfully."]);
    }

    public function workers()
    {
        $workers = Application::where('status', 'hired')->whereHas('job', function ($query) {
            $query->where('corporate_id', auth()->user()->corporate_id);
        })->with('job', 'applicant')->paginate(10);
        return view('employer.workers.index', compact('workers'));
    }
}
