<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colleges = College::withCount('students')->paginate(10);
        return view('college.index', compact('colleges'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:60', 'unique:colleges,name'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:colleges,email'],
            'phone' => ['required', 'string', 'max:60', 'unique:colleges,phone'],
            'address' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('college_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        $college = College::create($validated);
        User::where('id', auth()->user()->id)->update(['college_id' => $college->id]);
        DB::commit();
        return json_encode(['status' => 'success', 'message' => 'College created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $college = College::findOrFail($id);
        return view('college.show', compact('college'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $college = College::findOrFail($id);
        return view('college.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:60', 'unique:colleges,name'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:colleges,email'],
            'phone' => ['required', 'string', 'max:60', 'unique:colleges,phone'],
            'address' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('college_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        $college = College::findOrFail($id);
        $college->update($validated);
        DB::commit();

        return json_encode(['status' => 'success', 'message' => 'College updated successfully.']);
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
}
