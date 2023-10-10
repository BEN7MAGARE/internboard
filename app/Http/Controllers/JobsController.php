<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->category = new Category();
        $this->job = new Job();
    }


    public function index()
    {
        $jobs = $this->job->latest()->get();
        return view('jobs.create', compact('jobs'));
    }

    public function categories() {
        $categories = $this->category->latest()->get();
        return json_encode($categories);
    }


    public function create()
    {
        return view('jobs.create');
    }

    public function start(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'max:80'],
            'job_type' => ['required', 'max:100'],
            'experience_level' => ['required', 'max:100'],
            'location' => ['required', 'max:255'],
        ]);

        if (isset($request->job_id) && !is_null($request->job_id)) {
            $job = $this->job->find($request->job_id);
            $job->update($validated);
        }else {
            $job = $this->job->create($validated);
        }

        return json_encode(['status'=>'success', 'job'=> $job]);
    }

    public function store(Request $request) {
        $job = $this->job->find($request->job_id);
        $validated = $request->validate([
            'education_level' => ['required'],
            'skills' => ['required'],
            'salary_range' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'start_date' => ['required'],
        ]);
        if (!is_null($job)) {
            $job->update($validated);
        }
        return json_encode(['status'=>'success', 'message'=> 'Job post added successfully']);
    }

    public function show(string $id)
    {
        //
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
