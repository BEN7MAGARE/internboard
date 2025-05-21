<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollegeRequest;
use App\Models\College;
use App\Models\User;
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
        $collegeusers = User::where('role', 'college')->paginate(10);
        return view('college.index', compact('colleges', 'collegeusers'));
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
        return json_encode(['status' => 'success', 'message' => $message]);
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
}
