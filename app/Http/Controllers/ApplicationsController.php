<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->application = new Application();
        $this->job = new Job();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->application->query();
        if (auth()->user()->role === "student") {
            $query->where('user_id',auth()->id());
        }else if(auth()->user()->role === 'corporate') {
            $jobs = $this->job->where('corporate_id',auth()->user()->corporate_id)->pluck('id');
            $query->whereIn('job_id', $jobs);
        }elseif (auth()->user()->role === 'college') {
            $students = $this->user->where('college_id', auth()->user()->college_id)->pluck('id');
            $query->where('user_id',$students);
        }

        $applications = $query->with('job.corporate','applicant')->latest()->get();

        return view('apply.index', compact('applications'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
