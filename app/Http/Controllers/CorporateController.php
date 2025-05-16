<?php

namespace App\Http\Controllers;

use App\Models\Corporate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CorporateController extends Controller
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
        $corporates = Corporate::withCount('jobs')->paginate(10);
        return view('corporate.index', compact('corporates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'corporate' && auth()->user()->corporate_id === null) {
            return view('corporate.create');
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
            'name' => ['required', 'string', 'max:60', 'unique:corporates,name'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:corporates,email'],
            'phone' => ['required', 'string', 'max:60', 'unique:corporates,phone'],
            'address' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('corporate_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        $corporate = Corporate::create($validated);
        User::where('id', auth()->user()->id)->update(['corporate_id' => $corporate->id]);
        DB::commit();

        return json_encode(['status' => 'success', 'message' => 'Business created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        return view('corporate.show', compact('corporate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        return view('corporate.edit', compact('corporate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:60', 'unique:corporates,name'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:corporates,email'],
            'phone' => ['required', 'string', 'max:60', 'unique:corporates,phone'],
            'address' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);
        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('corporate_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        $corporate = Corporate::findOrFail($id);
        $corporate->update($validated);
        DB::commit();

        return json_encode(['status' => 'success', 'message' => 'Business updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        $corporate->delete();
        return json_encode(['status' => 'success', 'message' => 'Business deleted successfully.']);
    }
}
