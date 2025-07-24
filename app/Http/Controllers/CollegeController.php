<?php

namespace App\Http\Controllers;

use App\Exports\StudentImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCollegeRequest;
use App\Imports\StudentDataImport;
use App\Models\Application;
use App\Models\College;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CollegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('college');
        $this->user = new User();
        $this->application = new Application();
    }

    public function profile()
    {
        $studentscount = Student::where('college_id', auth()->user()->college_id)->count();
        $applicationscount = Application::whereIn('user_id', Student::where('college_id', auth()->user()->college_id)->pluck('id'))->count();
        $selectedcount = Application::whereIn('user_id', Student::where('college_id', auth()->user()->college_id)->pluck('id'))->where('status', 'selected')->count();
        $interviewcount = Application::whereIn('user_id', Student::where('college_id', auth()->user()->college_id)->pluck('id'))->where('status', 'interview')->count();
        $hiredcount = Application::whereIn('user_id', Student::where('college_id', auth()->user()->college_id)->pluck('id'))->where('status', 'hired')->count();
        return view('college.profile', [
            'user' => auth()->user(),
            'studentscount' => $studentscount,
            'applicationscount' => $applicationscount,
            'selectedcount' => $selectedcount,
            'interviewcount' => $interviewcount,
            'hiredcount' => $hiredcount,
        ]);
    }

    public function students()
    {
        $students = User::where('role', 'student')->where('college_id', auth()->user()->college_id)->with(['profile', 'college', 'student'])->paginate(10);
        return view('college.students.index', compact('students'));
    }

    public function courses()
    {
        $courses = Course::paginate(10);
        return view('college.courses.index', compact('courses'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colleges = College::withCount('students')->paginate(10);
        $collegeusers = User::where('role', 'college')->paginate(10);
        $courses = Course::with('category:id,name')->withCount('students')->paginate(10);
        return view('college.index', compact('colleges', 'collegeusers', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'college' && auth()->user()->college_id === null) {
            return view('college.create');
        } else {
            return redirect('profile');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollegeRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('college_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        if ($validated['id'] !== null) {
            $college = College::findOrFail($validated['id']);
            $college->update($validated);
            $message = 'College updated successfully.';
        } else {
            $college = College::create($validated);
            $message = 'College created successfully.';
        }
        User::where('id', auth()->user()->id)->update(['college_id' => $college->id]);
        DB::commit();
        return json_encode(['status' => 'success', 'message' => $message, 'url' => '/profile']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $college = College::findOrFail($id);
        return response()->json($college);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $college = College::findOrFail($id);
        return response()->json($college);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCollegeRequest $request, string $id)
    {
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('college_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        if ($validated['id'] !== null) {
            $college = College::findOrFail($validated['id']);
            $college->update($validated);
            $message = 'College updated successfully.';
        } else {
            $college = College::create($validated);
            $message = 'College created successfully.';
        }
        DB::commit();
        return json_encode(['status' => 'success', 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $college = College::findOrFail($id);
        $college->delete();
        return json_encode(['status' => 'success', 'message' => 'College deleted successfully.']);
    }

    public function getColleges()
    {
        $colleges = College::select('id', 'name')->get();
        return response()->json($colleges);
    }

    public function applications()
    {
        if (auth()->user()->role === 'college') {
            $college_id = auth()->user()->college_id;
            $students = $this->user->where('college_id', $college_id)->pluck('id');
            $applications = $this->application->whereIn('user_id', $students)->with('applicant')->latest()->paginate(10);
            return view('profile.schoolapplicants', compact('applications'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    public function dashboard()
    {
        if (auth()->user()->role === 'college') {
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

    public function downloadStudentsTemplate()
    {
        return Excel::download(new StudentImport(), 'students_import_template.xlsx');
    }

    public function importStudents(Request $request)
    {
        $college_id = auth()->user()->college_id;
        $request->validate([
            'students' => 'required|file|mimes:xlsx,xls,csv|max:10240',  // Max 10MB
        ]);
        try {
            Excel::import(new StudentDataImport($college_id), $request->file('students'));
            return response()->json(['status' => 'success', 'message' => 'Students imported successfully.']);
        } catch (\Exception $e) {
            Log::error('Student import failed: ' . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'An error occurred while importing students. Please check the log.']);
        }
    }
}
