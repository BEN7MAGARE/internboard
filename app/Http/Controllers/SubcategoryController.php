<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
        $subcategories = Subcategory::all();
        return view('subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        Subcategory::create($validated);
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return view('subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return view('subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        Subcategory::findOrFail($id)->update($validated);
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subcategory::findOrFail($id)->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully');
    }
}
