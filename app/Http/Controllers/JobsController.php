<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->category = new Category();
        $this->job = new Job();
        $this->skill = new Skill();
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
