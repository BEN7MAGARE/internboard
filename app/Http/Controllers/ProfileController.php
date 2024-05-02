<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Job;
use App\Models\Profile;
use App\Models\User;
use App\Models\User_Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->profile = new Profile();
        $this->user = new User();
        $this->job = new Job();
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    function jobs()
    {
        if (auth()->user()->role === "corporate") {
            $jobs = $this->job->where('corporate_id', auth()->user()->corporate_id)->withCount('applications')->latest()->get();
            return view('profile.jobs', compact('jobs'));
        } else {
            abort(405, "You are not authorised to access this resource");
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $validated = request()->validate([
            'title' => ['required', 'string'],
            'education_level' => ['required', 'string'],
            'course' => ['required', 'string'],
            'specialization' => ['required', 'string'],
            'summary' => ['required', 'string'],
            'first_name' => ['string', 'nullable', ''],
            'last_name' => ['string', 'nullable', ''],
            'address' => ['string', 'nullable'],
            'phone' => ['string', 'nullable', 'max:16', 'unique:users,phone,' . auth()->id()],
            'email' => ['string', 'required', 'unique:users,email,' . auth()->id()],
            'twitter' => ['string', 'nullable', 'max:255'],
            'facebook' => ['string', 'nullable', 'max:255'],
            'instagram' => ['string', 'nullable', 'max:255'],
            'linkedin' => ['string', 'nullable', 'max:255'],
            'level' => ['string', 'nullable'],
            'years_of_experience' => ['string', 'nullable'],
            // 'skills' => ['json']
        ]);

        $user = User::find(auth()->id());
        $user->title = $validated['title'];
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated["last_name"];
        $user->address = $validated["address"];
        $user->phone = $validated["phone"];
        $user->email = $validated["email"];
        $user->twitter = $validated["twitter"];
        $user->facebook = $validated["facebook"];
        $user->instagram = $validated["instagram"];
        $user->linkedin = $validated["linkedin"];

        if ($request->hasFile("image")) {
            $fileName = 'pr' . strtotime(now()) . auth()->id() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('profiles/', $fileName);
            $user->image = $fileName;
        }
        $user->update();
        if (is_null($user->profile)) {
            $this->profile->create([
                'user_id' => $user->id,
                'education_level' => $validated["education_level"],
                'course' => $validated["course"],
                'specialization' => $validated["specialization"],
                'summary' => $validated["summary"], 'level' => $validated["level"],
                'years_of_experience' => $validated["years_of_experience"],
            ]);
        } else {
            $user->profile->update([
                'education_level' => $validated["education_level"],
                'course' => $validated["course"],
                'specialization' => $validated["specialization"],
                'summary' => $validated["summary"],
                'level' => $validated["level"],
                'years_of_experience' => $validated["years_of_experience"],
            ]);
        }

        $skills = explode(',', $request->skills);
        // return $skills;
        foreach ($skills as $value) {
            User_Skill::create([
                'user_id' => $user->id,
                'skill_id' => $value,
            ]);
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
}
