<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class AssignmentAnswer extends Component
{
    use WithFileUploads;
    public $file;

    public function updatedFile()
    {
        $this->validate(['file'=>'image|max:2048|required']);
    }



    public function save(){
        $this->file->store('public/assignmentAnswer');
    }

    public function render()
    {
        return view('livewire.assignment-answer');
    }
}
