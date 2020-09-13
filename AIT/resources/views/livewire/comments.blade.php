<div class="d-flex justify-content-center">
    <div class="col-6">
        <h1 class="py-3">Comments</h1>
        {{-- {{ $error }} --}}
        @error('newComment')
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
        <form class="d-flex my-1" wire:submit.prevent='addComment'>
            <input type="text" class="form-control my-2 p-2 @error('newComment') is-invalid @enderror" placeholder="What's in your mind." wire:model.debounce.500ms="newComment">
            <div class="p-2">
                <button type='submit' class="btn btn-primary">
                    Add
                </button>
            </div>
        </form>
        
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
                </div>
            </div>
        @endforeach
        {{ $comments->links('chatSystem.pagination-links') }}
    </div>   
</div>
