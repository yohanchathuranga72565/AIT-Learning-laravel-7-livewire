<div class="d-flex justify-content-center">
    <div class="col-12">
        <h1 class="py-3">Comments</h1>
        {{-- {{ $error }} --}}
        @error('newComment')
            <span class="error text-danger">
                <p>{{ $message }}</p>
            </span>
        @enderror
        @error('imagec')
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
        @if ($imagec)
            <img src="{{ $imagec->temporaryUrl() }}" class="mb-1" width="200">
        @endif
        
        <div wire:loading wire:target="imagec"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
        
        @if ($active)
            <form class="my-1" wire:submit.prevent='addComment'>
                <button class="btn btn-sm btn-primary" onclick="document.getElementById('filec').click(); return false;">Add Image</button>
                <input type="file" id="filec"  class = "d-none @error('imagec') is-invalid @enderror" id="imagec" wire:model.debounce.500ms="imagec">
                
                <div class="d-flex my-1">
                    <input type="text" class="form-control my-2 p-2 @error('newComment') is-invalid @enderror" placeholder="What's in your mind." wire:model.debounce.500ms="newComment">
                    <div class="p-2">
                        <button type='submit' class="btn btn-primary">
                            Add
                        </button>
                    </div>
                </div> 
            </form> 
        @endif
        
        
        @foreach ($comments as $comment)
            <div class="card my-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            @if ($comment->user->isA('administrator'))

                                @if ($comment->user->admin->profile_image)
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/'.$comment->user->admin->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @else
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @endif
                            @elseif ($comment->user->isA('teacher'))

                                @if ($comment->user->teacher->profile_image)
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/'.$comment->user->teacher->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @else
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @endif
                            @elseif ($comment->user->isA('student'))

                                @if ($comment->user->student->profile_image)
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/'.$comment->user->student->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @else
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @endif
                            @elseif ($comment->user->isA('parent'))

                                @if ($comment->user->parent->profile_image)
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/'.$comment->user->parent->profile_image)}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @else
                                <div class="image">
                                    <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image" width="30">
                                </div>
                                @endif
                            @endif
                            <p class="mx-2 font-weight-bold">{{ $comment->user->name }}</p>
                            <h6 class="mx-2 font-weight-normal text-secondary">{{ $comment->created_at->diffForHumans() }}</h6>
                        </div>
                        @if (Auth::user()->id == $comment->user->id )
                            <div>
                                <button type="button" class="close" wire:click="remove( {{ $comment->id }})">
                                    <span aria-hidden="true" class="text-danger">&times;</span>
                                </button>
                            </div>   
                        @endif   
                    </div>
                    <p>
                        {{ $comment->body }}
                    </p> 
                    @if ($comment->image)
                        <img src="{{asset('storage/comment_images/'.$comment->image)}}" width="500" class="img-fluid rounded mx-auto d-block">
                    @endif
                </div>
            </div>
        @endforeach
        {{ $comments->links('chatSystem.pagination-links') }}
    </div>   
</div>
