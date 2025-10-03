<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }
    public function indexApi()
    {
        $students = \App\Models\Student::with('courses')->paginate(10);
        return StudentResource::collection($students);
    }
    public function show($id)
    {
        $student = Student::with('courses')->find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return new StudentResource($student);   
    }
    public function myCourses()
{
    $student = auth()->user(); // returns the authenticated Student model

    // eager load courses and map to a simple structure
    $courses = $student->courses()->get()->map(function ($course) {
        return [
            'id' => $course->id,
            'course_code' => $course->course_code,
            'course_name' => $course->course_name,
            'credits' => $course->credits,
            'status' => $course->pivot->status,
            'enrolled_on' => $course->pivot->enrolled_on,
        ];
    });

    return response()->json($courses);
}

}      