<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corporate;
use App\Models\Student;
use App\Models\Application;
use App\Models\Job;
use App\Models\College;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $corporatecount = Corporate::count();
        $studentcount = Student::count();
        $workercount = User::where('role','worker')->count();
        $applicationcount = Application::count();
        $jobcount = Job::count();
        $collegecount = College::count();
        return view('dashboard', compact('corporatecount', 'studentcount', 'workercount', 'applicationcount', 'jobcount', 'collegecount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
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
