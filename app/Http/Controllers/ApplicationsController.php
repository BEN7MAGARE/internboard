<?php

namespace App\Http\Controllers;

use App\Mail\Invitation;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApplicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except('elearning');
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
        if (auth()->user()->role === "student" || auth()->user()->role === "worker") {
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

    public function schoolStudentApplications($status = NULL)
    {
        if (auth()->user()->role === "college") {
            $college_id = auth()->user()->college_id;
            $applications = DB::select("CALL sp_getschoolapplicants($college_id,'$status')");
            return view('profile.schoolapplicants', compact('applications', 'status'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    public function collegeApplications()
    {
        if (auth()->user()->role === "college") {
            $college_id = auth()->user()->college_id;
            $students = $this->user->where('college_id', $college_id)->pluck('id');
            $applications = $this->application->whereIn('user_id', $students)->with('applicant')->latest()->paginate(10);
            return view('profile.schoolapplicants', compact('applications'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    public function studentDetails($id)
    {
        $student = $this->user->with('profile', 'skills')->find($id);
        return view('profile.student', compact('student'));
    }

    function downloadCV($application_id)
    {
        $application = $this->application->find($application_id);
        $filePath = public_path('applicant_resources/' . $application->curriculum_vitae);
        return response()->download($filePath);
    }

    public function download($fileName)
    {
        $filePath = public_path('applicant_resources/' . $fileName);
        return response()->download($filePath);
    }

    public function select(Request $request)
    {
        $corporate = auth()->user()->corporate;
        $applicants = json_decode($request->applicants, true);
        $message = $request->message;
        foreach ($applicants as $key => $value) {
            $application = $this->application->with('applicant')->find($value["applicationid"]);
            $application->status = "selected";
            $application->invitationletter = $message;
            $application->update();
            Mail::to($application->applicant->email, $application->applicant->first_name . ' ' . $application->applicant->last_name)
                ->send(new Invitation("Interview Invitation", $message, $corporate->email, $corporate->name));
        }
        return json_encode(['status' => 'success', 'message' => 'Applicants selected successfully']);
    }

    public function elearning()
    {
        return view('comingsoon');
    }
}
