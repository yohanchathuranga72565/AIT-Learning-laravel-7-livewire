<div class="d-flex justify-content-center">
    <div class="col-12">
        <h1 class="py-3">Questions</h1>
        {{-- {{ $error }} --}}
        @error('newQuestion')
            <span class="error text-danger">
                <p>{{ $message }}</p>
            </span>
        @enderror
        @error('image')
            <span class="error text-danger">
                <p>{{ $message }}</p>
            </span>
        @enderror
        {{-- flash messages showing --}}
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        @if ($image)
            <img src="{{ $image->temporaryUrl() }}" class="mb-1" width="200">
        @endif
        <div wire:loading wire:target="image"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
        
        
        <form class="my-1" wire:submit.prevent='addQuestion'>
            <button class="btn btn-sm btn-primary" onclick="document.getElementById('file').click(); return false;">Add Image</button>
            <input type="file" id="file"  class = "d-none @error('image') is-invalid @enderror" id="image" wire:model.debounce.500ms="image">
            
            <div class="d-flex my-1">
                <input type="text" class="form-control my-2 p-2 @error('newQuestion') is-invalid @enderror" placeholder="Type your question here." wire:model.debounce.500ms="newQuestion">
                <div class="p-2">
                    <button type='submit' class="btn btn-primary">
                        Add
                    </button>
                </div>
            </div>
            
        </form>
        
        @foreach ($questions as $question)
            <a href="#">
                <div class="card my-1 {{ $active == $question->id ? 'border border-primary':''}}" wire:click="$emit('questionSelected',{{ $question->id }})">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                @if ($question->user->isA('administrator'))

                                    @if ($question->user->admin->profile_image)
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/'.$question->user->admin->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @else
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @endif
                                @elseif ($question->user->isA('teacher'))

                                    @if ($question->user->teacher->profile_image)
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/'.$question->user->teacher->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @else
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @endif
                                @elseif ($question->user->isA('student'))

                                    @if ($question->user->student->profile_image)
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/'.$question->user->student->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @else
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @endif
                                @elseif ($question->user->isA('parent'))

                                    @if ($question->user->parent->profile_image)
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/'.$question->user->parent->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @else
                                    <div class="image">
                                        <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                    </div>
                                    @endif
                                @endif
                                <p class="mx-2 font-weight-bold">{{ $question->user->name }}</p>
                                <h6 class="mx-2 font-weight-normal text-secondary">{{ $question->created_at->diffForHumans() }}</h6>
                            </div>
                            @if (Auth::user()->id == $question->user->id )
                                <div>
                                    <button type="button" class="close" wire:click="remove( {{ $question->id }})">
                                        <span aria-hidden="true" class="text-danger">&times;</span>
                                    </button>
                                </div>   
                            @endif   
                        </div>
                        <p>
                            {{ $question->question }}
                        </p> 
                        @if ($question->image)
                            <img src="{{asset('storage/question_images/'.$question->image)}}" width="500" class="img-fluid rounded mx-auto d-block">
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
        {{ $questions->links('chatSystem.pagination-links') }}
    </div>   
</div>

