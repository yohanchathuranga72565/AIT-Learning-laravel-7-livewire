
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
              <div class="card-header text-center"><h5>{{ __('Assignment Link Creation') }}</h5></div>
          
              <div class="card-body">
                  <form method="post" action='{{ route('createAssingnment',$grade_id) }}' enctype = 'multipart/form-data'>
                      @csrf
          
                      <div class="form-group row">
                          <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title of the assignment') }}</label>
          
                          <div class="col-md-6">
                              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>
          
                              @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
          
                      <div class="form-group row">
                          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
          
                          <div class="col-md-6">
                              <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Enter Description"></textarea>
          
                              @error('description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                    <div class="form-group row">
                      <label for="dueDate" class="col-md-4 col-form-label text-md-right">{{ __('Due Date') }}</label>

                        <div class="col-md-6">
                            <input id="dueDate" type="text" class="form-control @error('dueDate') is-invalid @enderror" name="dueDate" value="{{ old('dueDate') }}" required readonly>

                            @error('dueDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
       
          
                    <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Upload assignment as a pdf') }}</label>
          
                        <div class="col-md-6">
                            <input id="file" type="file" class="@error('file') is-invalid @enderror" name="file">
          
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
          
                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Create') }}
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