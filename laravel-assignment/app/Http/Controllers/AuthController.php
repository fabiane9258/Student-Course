<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'password'      => 'required|string|min:6',
        ]);

        $student = Student::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'date_of_birth'=> $request->date_of_birth,
            'password'     => Hash::make($request->password),
        ]);

        $token = $student->createToken('apitoken')->plainTextToken;

        return response()->json([
            'token'   => $token,
            'student' => $student,
        ], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $student->createToken('apitoken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'student' => $student
        ]);
    }
}
