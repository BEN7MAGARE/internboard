<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->profile = Profile::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === "college") {
            $students = User::where('role', 'student')->where('college_id', auth()->user()->college_id)->with('profile')->paginate(10);
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
    public function store(ProfileRequest $request)
    {
        $validated = $request->validated();
        $user = User::find(auth()->id());
        $image = $user->image;
        if ($request->hasFile("image")) {
            $fileName = 'pr' . strtotime(now()) . auth()->id() . '.' . $request->file('image')->getClientOriginalExtension();
            if (Storage::disk('public')->exists('profilepictures/' . $user->image)) {
                Storage::disk('public')->delete('profilepictures/' . $user->image);
            }
            $request->file('image')->move('profilepictures/', $fileName);
            $image = $fileName;
        }
        $user->update($validated + ['image' => $image]);
        if (auth()->user()->role == "student") {
            if (is_null($user->profile)) {
                $this->profile->create([
                    'user_id' => $user->id,
                    'level' => $validated['level'],
                    'education' => $validated["education"],
                    'work' => $validated["work"],
                    'specialization' => $validated["specialization"],
                    'summary' => $validated["summary"],
                    'years_of_experience' => $validated["years_of_experience"],
                ]);
            } else {
                $user->profile->update([
                    'education' => $validated["education"],
                    'work' => $validated["work"],
                    'level' => $validated['level'],
                    'specialization' => $validated["specialization"],
                    'summary' => $validated["summary"],
                    'level' => $validated["level"],
                    'years_of_experience' => $validated["years_of_experience"],
                ]);
            }
            $skills = explode(',', $request->skills);
            foreach ($skills as $value) {
                User_Skill::create([
                    'user_id' => $user->id,
                    'skill_id' => $value,
                ]);
            }
        }
        return json_encode(['status' => 'success', 'message' => 'Profile information updated successfully.']);
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
