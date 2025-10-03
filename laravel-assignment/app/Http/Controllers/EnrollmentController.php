<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use App\Events\EnrollmentCreated;

class EnrollmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
        ]);

        DB::beginTransaction();
        try {
            // Check if already enrolled in this specific course
            $exists = Enrollment::where('student_id', $data['student_id'])
                ->where('course_id', $data['course_id'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => "Student {$data['student_id']} is already enrolled in course {$data['course_id']}"
                ], 422);
            }

            // Create new enrollment
            $enrollment = Enrollment::create([
                'student_id' => $data['student_id'],
                'course_id'  => $data['course_id'],
                'enrolled_on'=> now(),
                'status'     => 'active',
            ]);

            DB::commit();

            // Fire event
            EnrollmentCreated::dispatch($enrollment);

            return response()->json([
                'message'    => 'Enrollment successful',
                'enrollment' => $enrollment
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Enrollment failed', 'details' => $e->getMessage()], 500);
        }
    }
}
