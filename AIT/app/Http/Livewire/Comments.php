<?php

namespace App\Http\Livewire;

use App\Comment;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    // public $comments;
    use WithPagination;
    public $newComment;

    // public function mount(){
    //     $initialComments = Comment::latest()->paginate(2);
    //     $this->comments = $initialComments;
    // }

    public function updated($field)
    {
        $this->validateOnly($field, ['newComment'=> 'required|max:255']);
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        $comment->delete();
        // $this->comments = $this->comments->except($commentId);
        session()->flash('message', 'Comment deleted successfully.');
        // dd($comment);
    }

    public function addComment(){
        $this->validate(['newComment'=> 'required']);
        $createdComment = auth()->user()->comment()->create(['body'=>$this->newComment]);
        // $this->comments->push($createdComment);

        $this->newComment = "";

        session()->flash('message', 'Comment added successfully.');
        
    }


    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::latest()->paginate(2),
        ]);
    }
}
