
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
            {{-- @livewire('teacher.upload-resources',['grade_id' => $grade_id]) --}}
            <div class="card mt-3">
              <div class="card-header text-center"><h5>{{ __('Edit The File') }}</h5></div>
          
              <div class="card-body">
                  <form method="post" action='{{ route('editResourcesFile',$resources->id) }}' enctype = 'multipart/form-data'>
                      @csrf
          
                      <div class="form-group row">
                          <label for="capter" class="col-md-4 col-form-label text-md-right">{{ __('Capter') }}</label>
          
                          <div class="col-md-6">
                              <input id="capter" type="text" class="form-control @error('capter') is-invalid @enderror" name="capter" value="{{ $resources->capter }}" autocomplete="capter" readonly>
          
                              @error('capter')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
          
                      <div class="form-group row">
                          <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
          
                          <div class="col-md-6">
                              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $resources->title }}" readonly>
          
                              @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
          
          
          
                      <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Choose file') }}</label>
          
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