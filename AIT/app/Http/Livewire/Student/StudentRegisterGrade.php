<?php

namespace App\Http\Livewire\Student;

use App\Grade;
use Livewire\Component;

class StudentRegisterGrade extends Component
{
    public function render()
    {
        return view('livewire.student.student-register-grade',[
            'grades' => Grade::all()
        ]);
    }
}
