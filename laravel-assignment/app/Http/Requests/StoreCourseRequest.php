<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        // allow all for now (can restrict later)
        return true;
    }

    public function rules(): array
    {
        return [
            'course_code' => 'required|string|max:10|unique:courses,course_code',
            'course_name' => 'required|string|max:255',
            'credits'     => 'required|integer|between:1,5',
        ];
    }
}
