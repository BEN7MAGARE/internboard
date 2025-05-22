<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCollegeUserRequest;
use App\Http\Requests\StoreCorporateUserRequest;

class UserController extends Controller
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
        $users = User::all();
        $corporatesusers = User::where('role', 'corporate')->get();
        $collegeusers = User::where('role', 'college')->get();
        $jobseekers = User::where('role', 'worker')->get();
        return view('users.index', compact('users', 'corporatesusers', 'collegeusers', 'jobseekers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);
        User::findOrFail($id)->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function collegeUserStore(StoreCollegeUserRequest $request)
    {
        $validated = $request->validated();
        $validated['role'] = 'college';
        if ($validated['id'] !== null) {
            $user = User::findOrFail($validated['id']);
            $user->update($validated);
            $message = 'User updated successfully';
        } else {
            $validated['password'] = bcrypt('Dalma@2025');
            User::create($validated);
            $message = 'User created successfully';
        }
        return json_encode(['status' => 'success', 'message' => $message]);
    }

    public function corporateUserStore(StoreCorporateUserRequest $request)
    {
        $validated = $request->validated();
        $validated['role'] = 'corporate';
        if ($validated['id'] !== null) {
            $user = User::findOrFail($validated['id']);
            $user->update($validated);
            $message = 'User updated successfully';
        } else {
            $validated['password'] = bcrypt('Dalma@2025');
            User::create($validated);
            $message = 'User created successfully';
        }
        return json_encode(['status' => 'success', 'message' => $message]);
    }

}
