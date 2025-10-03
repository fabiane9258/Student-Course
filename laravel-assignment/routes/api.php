<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

Route::get('/students', [StudentController::class, 'indexApi']);
Route::get('/students/{id}', [StudentController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/enrollments', [EnrollmentController::class, 'store']);
    Route::get('/my-courses', [StudentController::class, 'myCourses']);
});
