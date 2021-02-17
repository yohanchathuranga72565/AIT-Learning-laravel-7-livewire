@extends('layouts.app')


@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
          {{-- <h2>Upload new lesson</h2> --}}
        </div>
        
        <div class="row justify-content-center">
            
          <div class="col-md-8">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">  
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('warning'))
                <div class="alert alert-danger" role="alert">  
                    {{ session()->get('warning') }}
                </div>
            @endif
            {{-- @livewire('teacher.upload-resources',['grade_id' => $grade_id]) --}}
            <div class="card mt-3">
              <div class="card-header text-center"><h5>{{ __('Edit Assignment Due Date') }}</h5></div>
          
              <div class="card-body">
                  <form method="post" action='{{ route('editAssignment',$assignment['id']) }}' enctype = 'multipart/form-data'>
                      @csrf
          
                      <div class="form-group row">
                          <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title of the assignment') }}</label>
          
                          <div class="col-md-6">
                              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"  autocomplete="title" autofocus value="{{ $assignment['title'] }}" readonly>
          
                              @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
          
                

                    <div class="form-group row">
                      <label for="dueDate" class="col-md-4 col-form-label text-md-right">{{ __('Due Date') }}</label>

                        <div class="col-md-6">
                            <input id="dueDate1" type="text" class="form-control @error('dueDate') is-invalid @enderror" name="dueDate1" value="{{ $assignment['due_date'] }}" readonly>

                            @error('dueDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
       
          
                    
          
                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Edit') }}
                              </button>
                          </div>
                      </div>
                  </form>
            </div>
          </div>
              
        </div>
      </div>
    </div>
    
@endsection