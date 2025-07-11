<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('jobs');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('jobs')->paginate(10);
        $subcategories = Subcategory::withCount('jobs')->paginate(10);
        $jobs = Job::with(['corporate', 'category', 'subcategory'])->paginate(10);
        return view('categories.index', compact('categories', 'subcategories', 'jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->id) && $request->id) {
            $validated = $request->validate([
                'name' => 'required',
                'description' => 'nullable',
            ]);
            $category = Category::findOrFail($request->id)->update($validated);
            return json_encode(['status' => 'success', 'message' => 'Category updated successfully']);
        } else {
            $validated = $request->validate([
                'name' => 'required',
                'description' => 'nullable',
            ]);
            Category::create($validated);
            return json_encode(['status' => 'success', 'message' => 'Category created successfully']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'data' => $category,
        ]);
    }

    public function jobs(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $jobs = Job::where('category_id', $category->id)->paginate(10);
        return view('jobs.index', compact('category', 'jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        Category::findOrFail($id)->update($validated);
        return json_encode(['status' => 'success', 'message' => 'Category updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();
        return json_encode(['status' => 'success', 'message' => 'Category deleted successfully']);
    }

    public function getSubCategories($categoryid)
    {
        $subcategories = Subcategory::where('category_id', $categoryid)->get();
        return json_encode($subcategories);
    }
}
