<?php

namespace App\Http\Livewire;

use App\Comment;

use Carbon\Carbon;
use Livewire\Component; 
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Rules\ImageValidationWithNull;
use Illuminate\Support\Facades\Storage;

class Comments extends Component
{
    // public $comments;
    use WithPagination;
    use WithFileUploads;
    public $newComment;
    public $imagec;
    public $questionId;
    public $active;
    public $extension;

    // public function mount(){
    //     $initialComments = Comment::latest()->paginate(2);
    //     $this->comments = $initialComments;
    // }

    protected $listeners = ['questionSelected'];


    public function questionSelected($questionId){
        $this->questionId = $questionId;
        $this->active = $questionId;
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['newComment'=> 'required|max:255']);
    }

    public function updatedImage()
    {
        $filename = null;
        if($this->imagec){
            $filename = $this->imagec->getClientOriginalname();
        }
        
        $this->validate(['imagec' => ['max:10240',new ImageValidationWithNull($filename)]]);
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        if($comment->image){
            Storage::delete('/public/comment_images/'.$comment->image);
        }
        $comment->delete();
        // $this->comments = $this->comments->except($commentId);
        session()->flash('message', 'Comment deleted successfully.');
        // dd($comment);
    }

    public function addComment(){
        $filename = null;
        if($this->imagec){
            $filename = $this->imagec->getClientOriginalname();
        }
        $this->validate(['newComment'=> ['required'],
                         'imagec' => ['max:10240',new ImageValidationWithNull($filename)]]);

        $image = $this->storeImage();
        $createdComment = auth()->user()->comment()->create(['body'=>$this->newComment, 'image'=> $image, 'question_id'=> $this->questionId]);
        // $this->comments->push($createdComment);

        $this->newComment = "";
        $this->imagec = NULL;

        session()->flash('message', 'Comment added successfully.');
        
    }

    public function storeImage(){
        if(!$this->imagec){
            return null;
        }
        
            $filename = $this->imagec->getClientOriginalname();
            $this->imagec->storeAs('public/comment_images',$filename);
            return $filename;
        
    }


    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::where('question_id',$this->questionId)->latest()->paginate(2),
        ]);
    }
}
