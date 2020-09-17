<?php

namespace App\Http\Livewire;

use App\Comment;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Comments extends Component
{
    // public $comments;
    use WithPagination;
    use WithFileUploads;
    public $newComment;
    public $image;
    public $questionId;
    public $active;

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
        $this->validate(['image' => 'max:10240']);
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
        $this->validate(['newComment'=> 'required',
                         'image' => 'max:10240']);

        $image = $this->storeImage();
        $createdComment = auth()->user()->comment()->create(['body'=>$this->newComment, 'image'=> $image, 'question_id'=> $this->questionId]);
        // $this->comments->push($createdComment);

        $this->newComment = "";
        $this->image = NULL;

        session()->flash('message', 'Comment added successfully.');
        
    }

    public function storeImage(){
        if(!$this->image){
            return null;
        }
        
            $filename = $this->image->getClientOriginalname();
            $this->image->storeAs('public/comment_images',$filename);
            return $filename;
        
    }


    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::where('question_id',$this->questionId)->latest()->paginate(2),
        ]);
    }
}