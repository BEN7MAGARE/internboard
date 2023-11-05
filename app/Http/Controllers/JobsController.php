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
        $jobs = $this->job->latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function categories() {
        $categories = $this->category->latest()->get();
        return json_encode($categories);
    }

    public function skills()  {
        $skills = $this->skill->get();
        return json_encode($skills);
    }

    public function create()
    {
        return view('jobs.create');
    }


    public function store(JobRequest $request) {
        $validated = $request->validated();
        DB::beginTransaction();
        $job = $this->job->create(['ref_no'=>strtoupper(Str::random(3)).strtotime(now())]+$validated);
        foreach (explode(',', json_decode($validated["skills"], true)) as $value) {
            DB::table('job_skill')->insert(['job_id'=>$job->id, 'skill_id'=>$value]);
        }
        DB::commit();
        return json_encode(['status'=>'success', 'message'=> 'Job post added successfully']);
    }

    public function show(string $id)
    {
        $job = $this->job->find($id);
        return json_encode($job);
    }

    public function jobs() {
        $jobs = $this->job->latest()->get();
        return json_encode($jobs);
    }

    public function apply($ref_no) {
        $job = $this->job->where('ref_no', $ref_no)->orWhere('id',$ref_no)->with('corporate')->first();
        $application = $this->application->where('job_id',$job->id)->where('user_id',auth()->id())->first();
        $applied = false;
        if (!is_null($application)) {
            $applied = true;
        }
        return view('jobs.apply', compact('job', 'applied'));
    }

    function applicationCreate(Request $request) {
        $validated = $request->validate([
            'job_id' => ['required','exists:jobs,id'],
            'reason' => ['required','string'],
            'cover_letter' => ['required','max:1000'],
            'curriculum_vitae' => ['nullable','max:500'],
            'files' => ['nullable'],
        ]);
        $application = $this->application->where('user_id',auth()->id())->where('job_id',$validated["job_id"])->first();
        if (!is_null($application)) {
            return json_encode(['status'=>'success','message'=> "You have already applied for this job. Thank you"]);
        }
        $job = $this->job->find($validated["job_id"]);
        $filename = "";
        if ($request->hasFile('curriculum_vitae')) {
            $filename .= 'CV'.auth()->id() .$job->ref_no. strtotime(now()).'.'.$request->file('curriculum_vitae')->getClientOriginalExtension();
            $request->file('curriculum_vitae')->storeAs('applications/', $filename);
        }
        $fileNames = [];
        if (isset($request->files)) {
            foreach ($request->file('files') as $file) {
                $fileName = auth()->id() .$job->ref_no. strtotime(now()).'.'.$file->getClientOriginalExtension(); // or any other desired file name
                $file->move('applications/', $fileName);
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
        $application->save();

        return json_encode(['status'=>'success', 'message'=>'Job application saved successfully']);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
