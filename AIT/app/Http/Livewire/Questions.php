<?php

namespace App\Http\Livewire;

use App\Comment;

use App\Question;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Rules\ImageValidationWithNull;
use Illuminate\Support\Facades\Storage;

class Questions extends Component
{
    // public $comments;
    use WithPagination;
    use WithFileUploads;
    public $newQuestion;
    public $image;
    public $active;

    // public function mount(){
    //     $initialComments = Comment::latest()->paginate(2);
    //     $this->comments = $initialComments;
    // }

    protected $listeners = ['questionSelected'];

    public function questionSelected($questionId){
        $this->active = $questionId;
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['newQuestion'=> 'required|max:255']);
    }

    public function updatedImage()
    {
        $filename = null;
        if($this->image){
            $filename = $this->image->getClientOriginalname();
        }
        
        $this->validate(['image' => ['max:10240',new ImageValidationWithNull($filename)]]);
    }

    public function remove($questionId){
        $question = Question::find($questionId);
        $comments = Comment::where('question_id',$questionId)->get();
        foreach($comments as $comment){
            if($comment->image){
                Storage::delete('/public/comment_images/'.$comment->image);
            }
            $comment->delete();
        }
        
        if($question->image){
            Storage::delete('/public/question_images/'.$question->image);
        }
        $question->delete();
        // $this->comments = $this->comments->except($commentId);
        session()->flash('message', 'question deleted successfully.');
        // dd($comment);
    }

    public function addQuestion(){
        $filename = null;
        if($this->image){
            $filename = $this->image->getClientOriginalname();
        }
        $this->validate(['newQuestion'=> ['required'],
                         'image' => ['max:10240',new ImageValidationWithNull($filename)]]);

        $image = $this->storeImage();
        $createdQuestion = auth()->user()->question()->create(['question'=>$this->newQuestion, 'image'=> $image]);
        // $this->comments->push($createdComment);

        $this->newQuestion = "";
        $this->image = NULL;

        session()->flash('message', 'Question added successfully.');
        
    }

    public function storeImage(){
        if(!$this->image){
            return null;
        }
        
            $filename = $this->image->getClientOriginalname();
            $this->image->storeAs('public/question_images',$filename);
            return $filename;
        
    }


    public function render()
    {
        return view('livewire.questions',[
            'questions' => Question::latest()->paginate(2),
        ]);
    }
}
