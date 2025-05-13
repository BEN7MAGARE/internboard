<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Corporate;
use App\Models\Job;
use App\Models\Profile;
use App\Models\User;
use App\Models\User_Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->profile = new Profile();
        $this->user = new User();
        $this->job = new Job();
        $this->corporate = new Corporate();
    }

    function index()
    {
        return view('profile.index');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    function jobs()
    {
        if (auth()->user()->role === "corporate") {
            $jobs = $this->job->where('corporate_id', auth()->user()->corporate_id)->withCount('applications')->latest()->paginate(10);
            return view('profile.jobs', compact('jobs'));
        } else {
            return redirect()->route('profile.edit');
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileRequest $request)
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
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }

    function password(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $user = $this->user->fins(auth()->id());
        $user->update([
            'password' => Hash::make($validated["password"]),
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    function students()
    {
        if (auth()->user()->role !== "admin") {
            return redirect()->route('profile.edit');
        }
        $students = $this->user->where('role', 'student')->with('college:id,name')->paginate(10);
        return view('profile.students', compact('students'));
    }

    function corporates()
    {
        if (auth()->user()->role !== "admin") {
            return redirect()->route('profile.edit');
        }
        $corporates = $this->corporate->with('users:id,first_name,last_name')->paginate(10);
        return view('profile.corporates', compact('corporates'));
    }

    function opportunities()
    {
        if (auth()->user()->role !== "admin") {
            return redirect()->route('profile.edit');
        }
        $opportunities = $this->job->latest()->with(['user:id,first_name,last_name', 'corporate:id,name', 'category:id,name'])->paginate(10);
        return view('profile.opportunities', compact('opportunities'));
    }

    public function changeImage(Request $request)
    {
        $user = $this->user->find(auth()->id());
        $image = $user->image;
        if ($request->hasFile("profile")) {
            $fileName = 'pr' . strtotime(now()) . auth()->id() . '.' . $request->file('profile')->getClientOriginalExtension();
            if (Storage::disk('public')->exists('profilepictures/' . $user->image)) {
                Storage::disk('public')->delete('profilepictures/' . $user->image);
            }
            $request->file('profile')->move('profilepictures/', $fileName);
            $image = $fileName;
        }
        $user->image = $image;
        $user->update();
        return json_encode(['status'=>'success','message'=>'Profile image changed successfully']);
    }

    public function applications()
    {
        if (auth()->user()->role !== "corporate") {
            return redirect()->route('profile.edit');
        }
        $applications = $this->application->whereIn('job_id', auth()->user()->corporate->jobs->pluck('id'))->with('job:id,title')->paginate(10);
        return view('profile.applications', compact('applications'));
    }
}
