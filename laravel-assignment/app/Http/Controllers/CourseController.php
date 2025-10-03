<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // List all courses
    public function index()
    {
        return Course::all();
    }

    // Store a new course (already working with validation)
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());

        return response()->json([
            'message' => 'Course created successfully!',
            'course'  => $course
        ], 201);
    }

    // Show a single course by ID
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return $course;
    }

    // Update an existing course
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());

        return response()->json([
            'message' => 'Course updated successfully!',
            'course'  => $course
        ]);
    }

    // Delete a course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully!']);
    }
}
