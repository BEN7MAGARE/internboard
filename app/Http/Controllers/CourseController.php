<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('category:id,name')->withCount('students')->paginate(10);
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CourseCategory::all();
        return view('course.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        if ($validated['id'] !== null) {
            $course = Course::findOrFail($validated['id']);
            $course->update($validated);
            $message = 'Course updated successfully.';
        } else {
            $course = Course::create($validated);
            $message = 'Course created successfully.';
        }
        DB::commit();
        return json_encode(['status' => 'success', 'message' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with('category:id,name')->findOrFail($id);
        return json_encode($course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::with('category:id,name')->findOrFail($id);
        return json_encode($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        if ($validated['id'] !== null) {
            $course = Course::findOrFail($validated['id']);
            $course->update($validated);
            $message = 'Course updated successfully.';
        } else {
            $course = Course::create($validated);
            $message = 'Course created successfully.';
        }
        DB::commit();
        return json_encode(['status' => 'success', 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return json_encode(['status' => 'success', 'message' => 'Course deleted successfully.']);
    }

    public function getCourses()
    {
        $courses = Course::select('id', 'name')->get();
        return json_encode($courses);
    }

    public function getCourseCategories()
    {
        $categories = CourseCategory::all();
        return json_encode($categories);
    }
}
