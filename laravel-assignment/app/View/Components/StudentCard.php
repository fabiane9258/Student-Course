<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Student;

class StudentCard extends Component
{
    public $student;

    /**
     * Create a new component instance.
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.student-card');
    }
}
