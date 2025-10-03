<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_enroll_in_course(): void
    {
        // create a test student
        $student = Student::factory()->create();

        // create a test course
        $course = Course::factory()->create();

        // act as student using Sanctum
        $this->actingAs($student, 'sanctum');

        // send POST request to enroll
        $response = $this->postJson('/api/enrollments', [
            'student_id' => $student->id,
            'course_id'  => $course->id,
        ]);

        // assert success
        $response->assertStatus(201);

        // check that the enrollment exists in DB
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'course_id'  => $course->id,
            'status'     => 'active',
        ]);
    }
}
