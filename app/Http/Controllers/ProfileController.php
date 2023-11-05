<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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
        ]);
        $user = User::find(auth()->id());
        return $user;
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
            $fileName = 'pr'.strtotime(now()).auth()->id().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('profiles/',$fileName);
            $user->image = $fileName;
        }
        $user->update();

        $user->profile()->createOrUpdate([
            'education_level' => $validated["education_level"],
            'course' => $validated["course"],
            'specialization' => $validated["specialization"],
            'summary' => $validated["summary"]
        ]);

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
}
