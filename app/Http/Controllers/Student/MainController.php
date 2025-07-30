<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\County;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;
use App\Models\Contract;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
        $this->profile = Profile::class;
    }

    public function profile()
    {
        $applicationscount = Application::where('user_id', auth()->user()->id)->count();
        $selectedapplications = Application::where('user_id', auth()->user()->id)->where('status', 'selected')->count();
        $interviewapplications = Application::where('user_id', auth()->user()->id)->where('status', 'interview')->count();
        $hiredapplications = Application::where('user_id', auth()->user()->id)->where('status', 'hired')->count();
        return view('students.profile', [
            'user' => auth()->user(),
            'applicationscount' => $applicationscount,
            'selectedapplications' => $selectedapplications,
            'interviewapplications' => $interviewapplications,
            'hiredapplications' => $hiredapplications,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'college') {
            $students = User::where('role', 'student')->where('college_id', auth()->user()->college_id)->with(['profile', 'college', 'student'])->paginate(10);
            return view('students.index', compact('students'));
        } else if (auth()->user()->role === 'admin') {
            $students = User::where('role', 'student')->with(['profile', 'college', 'student'])->paginate(10);
            return view('students.index', compact('students'));
        } else {
            return redirect()->back()->with('errors', 'You are not authorised to access this resource');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt('Dalma@2025');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profilepictures'), $image_name);
            $validated['image'] = $image_name;
        }
        DB::beginTransaction();
        $validated['role'] = 'student';
        if ($validated['id'] === null) {
            $user = User::create($validated);
            Student::create($validated + ['user_id' => $user->id]);
            $message = 'Student created successfully.';
        } else {
            $user = User::with('student')->findOrFail($validated['id']);
            $user->update($validated);
            if ($user->student !== null) {
                $student = Student::findOrFail($validated['student_id']);
                $student->update($validated);
            } else {
                Student::create($validated + ['user_id' => $user->id]);
            }
            $message = 'Student updated successfully.';
        }
        DB::commit();
        return json_encode(['status' => 'success', 'message' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = User::with(['profile', 'college', 'student'])->findOrFail($id);
        return json_encode($student);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::with(['profile', 'college', 'student'])->findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = User::findOrFail($id);
        $user->update($validated);
        $user->profile()->update($validated);
        return json_encode(['status' => 'success', 'message' => 'Student updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
    }

    public function filter(Request $request)
    {
        $query = User::where('role', 'student');
        if ($request->filled('college_id')) {
            $query->where('college_id', $request->college_id);
        }
        $query->whereHas('student', function ($q) use ($request) {
            if ($request->filled('course_id') && $request->course_id !== null) {
                $q->where('course_id', $request->course_id);
            }
            if ($request->filled('level_of_study') && $request->level_of_study !== null) {
                $q->where('course_level', $request->level_of_study);
            }
            if ($request->filled('year_of_study') && $request->year_of_study !== null) {
                $q->where('year_of_study', $request->year_of_study);
            }
            if ($request->has('sponsored') && $request->sponsored === 'on') {
                $q->where('sponsored', true);
            }
        });
        $students = $query->with(['profile', 'college', 'student', 'student.course'])->get();
        return json_encode($students);
    }

    public function export(Request $request)
    {
        $students = User::where('role', 'student')->where('id', $request->student_id)->with(['profile', 'college', 'student', 'student.course'])->get();
        $fileName = 'students.xlsx';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        $callback = function () use ($students) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ADM NO', 'Name', 'Email', 'Phone', 'Gender', 'College', 'Course', 'Reg Number', 'Year']);
            foreach ($students as $student) {
                $education = json_decode($student->profile?->education);
                fputcsv($file, [
                    $student->student?->admision_number,
                    $student->title . '. ' . $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                    $student->id_no,
                    $student->student?->admision_number,
                    $student->email,
                    $student->phone,
                    $student->gender,
                    $student->college?->name,
                    $student->student?->course_level,
                    $student->student?->course?->name,
                    $student->student?->reg_number,
                    $student->student?->year_of_study,
                    $student->student->kin_name,
                    $student->student->kin_phone,
                    $student->student->kin_email,
                    $student->student->kin_relationship,
                    $student->student->sponsored ? 'Yes' : 'No',
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function contracts()
    {
        $contracts = Contract::where('user_id', auth()->user()->id)->with(['job','application', 'job.corporate'])->get();
        return view('student.contracts', compact('contracts'));
    }

    public function applications()
    {
        $applications = Application::where('user_id', auth()->user()->id)->with(['job', 'job.corporate'])->get();
        return view('student.application', compact('applications'));
    }

}
