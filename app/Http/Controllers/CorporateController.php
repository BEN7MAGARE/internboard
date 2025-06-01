<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorporateRequest;
use App\Models\Category;
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
        $corporatesusers = User::where('role', 'corporate')->paginate(10);
        return view('corporate.index', compact('corporates', 'corporatesusers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        if (auth()->user()->role === 'corporate') {
            return view('corporate.create', compact('categories'));
        } else {
            return redirect('profile');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCorporateRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('corporate_logos'), $filename);
            $validated['logo'] = $filename;
        }
        DB::beginTransaction();
        if ($validated['id'] !== null) {
            $corporate = Corporate::findOrFail($validated['id']);
            $corporate->update($validated);
            $message = 'Corporate updated successfully.';
        } else {
            $corporate = Corporate::create($validated);
            if (auth()->user()->role === 'corporate') {
                User::where('id', auth()->user()->id)->update(['corporate_id' => $corporate->id]);
            }
            $message = 'Corporate created successfully.';
        }
        DB::commit();

        return json_encode(['status' => 'success', 'message' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        return json_encode($corporate);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $corporate = Corporate::findOrFail($id);
        return json_encode($corporate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCorporateRequest $request, string $id)
    {
        DB::beginTransaction();
        $validated = $request->validated();
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

    public function getCorporates()
    {
        $corporates = Corporate::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->get(['id', 'name']);
        return json_encode($corporates);
    }

    public function handleCorporate(StoreCorporateRequest $request)
    {
        $validated = $request->validated();
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
}
