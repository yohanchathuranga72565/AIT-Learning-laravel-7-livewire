<?php

namespace App\Http\Livewire\Admin;

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
            if(auth()->user()->admin->profile_image){
                Storage::delete('/public/profileImages/'.auth()->user()->admin->profile_image);
            }
            $image = $this->storeImage();
            //         $request->image->storeAs('profileImages',$filename,'public');
            auth()->user()->admin()->update(['profile_image'=> $image]);
                return redirect(route('admin.show',auth()->user()->admin->id));
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
        return view('livewire.admin.edit-image');
    }
}
