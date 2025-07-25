<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('skills.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'=>['required','numeric','exists:categories,id'],
            'name' => 'required',
            'description' => 'nullable',
        ]);
        Skill::create($validated);
        return response()->json([
            'status'=>'success',
            'message'=>'Skill created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Skill::find($id));
    }

    public function getSkills()
    {
        if (auth()->user()->role === "corporate" && auth()->user()->corporate_id !== null) {
            if (auth()->user()->corporate->category_id!==null) {
                $skills = Skill::where('category_id', auth()->user()->corporate->category_id)->get();
                if ($skills->isEmpty()||$skills->count() < 5) {
                    $skills = Skill::all();
                }
                return response()->json($skills);
            }else{
                $skills = Skill::all();
                return response()->json($skills);
            }
        }
        return response()->json(Skill::all());
    }

    public function getSkillsByCategory(string $id)
    {
        return response()->json(Skill::where('category_id', $id)->get());
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

    public function skillsByCategory(string $id)
    {
        return response()->json(Skill::where('category_id', $id)->get());
    }
}
