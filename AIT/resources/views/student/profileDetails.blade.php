@extends('layouts.app')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 mt-3">
              @if ($student->profile_image)
                  <img src="{{asset('storage/profileImages/'.$student->profile_image)}}" class="rounded img-fluid" width='100%' alt="User Image"><br><br> 
              @else
                  <img src="{{asset('storage/profileImages/profile.png')}}" class="rounded img-fluid" width='100%' alt="User Image">
              @endif
        
              @if (Auth::user()->isA('student'))
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target=".edit-profile"><i class="fa fa-user" aria-hidden="true"></i> Edit profile Details</a>
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#edit-profile-image"><i class="fa fa-camera" aria-hidden="true"></i> Edit profile Image</a>   
              @endif
            </div>
            <div class="col-12 col-lg-8 mt-3">
                <div class="card">
                    <div class="card-header">
                      Profile Details
                    </div>
                    <div class="card-body">
                      <h5 class="card-title my-2">Name</h5>
                      <p class="card-text"><input type="text" class="form-control" value="{{ $student->name }}" readonly></p>
                      <h5 class="card-title my-2">Email</h5>
                      <p class="card-text"><input type="text" class="form-control" value="{{ $student->email }}" readonly></p>
                      <h5 class="card-title my-2">Address</h5>
                      <p class="card-text"><input type="text" class="form-control" value="{{ $student->address }}" readonly></p>
                      <h5 class="card-title my-2">Birth date</h5>
                      <p class="card-text"><input type="text" class="form-control" value="{{ $student->dob }}" readonly></p>
                      <h5 class="card-title my-2">Gender</h5>
                      <p class="card-text"><input type="text" class="form-control" value="{{ $student->gender }}" readonly></p>
                      <h5 class="card-title my-2">Mobile Number</h5>
                      <p class="card-text"><input type="text" class="form-control" value="{{ $student->phone_number }}" readonly></p>
                      <h5 class="card-title my-2">Grade</h5>
                      <p class="card-text"><input type="text" class="form-control" value="{{ $student->grade->grade }}" readonly></p>
                    </div>
                  </div>
            </div>

        </div>
    </div>
    
@endsection