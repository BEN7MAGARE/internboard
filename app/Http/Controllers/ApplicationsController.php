<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->application = new Application();
        $this->job = new Job();
        $this->user = new User();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->application->query();
        if (auth()->user()->role === "student") {
            $query->where('user_id', auth()->id());
        } else if (auth()->user()->role === 'corporate') {
            $jobs = $this->job->where('corporate_id', auth()->user()->corporate_id)->pluck('id');
            $query->whereIn('job_id', $jobs);
        } elseif (auth()->user()->role === 'college') {
            $students = $this->user->where('college_id', auth()->user()->college_id)->pluck('id');
            $query->where('user_id', $students);
        }

        $applications = $query->with('job.corporate', 'applicant')->latest()->get();

        return view('apply.index', compact('applications'));
    }


    public function collegeStudents()
    {
        if (auth()->user()->role === "college") {
            $students = $this->user->where('role', 'student')->where('college_id', auth()->user()->college_id)->with('profile')->paginate(10);
            return view('profile.collegestudents', compact('students'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    public function collegeDashboard()
    {
        if (auth()->user()->role === "college") {
            $studentscount = $this->user->where('role', 'student')->where('college_id', auth()->user()->college_id)->count();
            $college_id = auth()->user()->college_id || NULL;
            $applicationscount = DB::select("CALL sp_getschoolapplicantscount($college_id)");
            $selectedcount = DB::select("CALL sp_gecollegetapplicantscountbystatus($college_id,'selected')");
            $hiredcount = DB::select("CALL sp_gecollegetapplicantscountbystatus($college_id,'hired')");
            return view('profile.collegedashboard', compact('studentscount', 'applicationscount', 'selectedcount', 'hiredcount'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    public function getCollegeApplicants()
    {
        if (auth()->user()->role === "college") {
            $college_id = auth()->user()->college_id;
            $applications = DB::select("CALL sp_getschoolapplicants($college_id,NULL)");
            return json_encode($applications);
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    public function schoolStudentApplications($status= NULL) {
        if (auth()->user()->role === "college") {
            $college_id = auth()->user()->college_id;
            $applications = DB::select("CALL sp_getschoolapplicants(28,'$status')");
            return view('profile.schoolapplicants',compact('applications'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    public function studentDetails($id)
    {
        $student = $this->user->with('profile')->find($id);
        return view('profile.student',compact('student'));
    }

}
