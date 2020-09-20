<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditImage extends Component
{
    use WithFileUploads;
    public $image;
    public function profileUpload(){
        
        $this->validate(['image' => ['required','image','max:10240']]);


        if($this->image){
            if(auth()->user()->student->profile_image){
                Storage::delete('/public/profileImages/'.auth()->user()->student->profile_image);
            }
            $image = $this->storeImage();
            //         $request->image->storeAs('profileImages',$filename,'public');
            auth()->user()->student()->update(['profile_image'=> $image]);
                return redirect(route('student.show',auth()->user()->student->id));
            }
    }

    public function storeImage(){
        if(!$this->image){
            return null;
        }
        
            $filename = $this->image->getClientOriginalname();
            $this->image->storeAs('public/profileImages',$filename);
            return $filename;
        
    }
    
    public function render()
    {
        return view('livewire.student.edit-image');
    }
}
