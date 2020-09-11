<?php

namespace App\Http\Livewire\Parent;

use App\Student;
use Livewire\Component;
use App\Rules\linkStudentEmail;

class LinkStudentToParent extends Component
{
    public $email;
    public $idl;

    public function validation(){
        $this->validate(['email'=>['required','email',new LinkStudentEmail($this->email)]]);
        
        $this->idl = Student::where('email',$this->email)->get('id');
        //  = $student;
        return redirect(route('linkStudent',$this->idl[0]['id']));

    }

    

    public function render()
    {
        return view('livewire.parent.link-student-to-parent');
    }
}
