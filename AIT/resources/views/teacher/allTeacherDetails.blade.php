@extends('layouts.app')

@section('content')
    <div class="container my-2">
        <div class="row justify-content-center my-2">
          <h2>Teacher Accounts</h2>
        </div>
        <div class="row justify-content-center my-2">
          <div class="col-2">
            <a href="{{route('teacher.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-sm fa-user-plus" aria-hidden="true"></i> Create new account</a>
          </div>
          <div class="col-10">
              {{-- can write something --}}
          </div>
        </div>
        <div class="row justify-content-center">
            <table class="table table-hover table-sm table-responsive-lg">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    {{-- <th scope="col">SUbject</th> --}}
                    <th scope="col"></th>
                
                  </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <th scope="row">{{ $teacher->id }}</th>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            {{-- <td>{{ $student->subject }}</td> --}}
                            <td class="text-right">
                            <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="{{ '#profile'.$teacher->id }}" ><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                            <a class="btn btn-sm btn-danger" href="#" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
                        </tr>

                        {{-- view modal relate to the row --}}
                        <div class="modal fade" id="{{ 'profile'.$teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Profile Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  
                                    <div class="row justify-content-center">
                                        <div class="col-12 mt-3">
                                            @if ($teacher->profile_image)
                                                <img src="{{asset('storage/profileImages/'.$teacher->profile_image)}}" class="rounded img-fluid" width='100%' alt="User Image"><br><br> 
                                            @else
                                                <img src="{{asset('storage/profileImages/profile.png')}}" class="rounded img-fluid" width='100%' alt="User Image">
                                            @endif    
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="card">
                                                <div class="card-body">
                                                  <h5 class="card-title my-2">Name</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $teacher->name }}" readonly></p>
                                                  <h5 class="card-title my-2">Email</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $teacher->email }}" readonly></p>
                                                  <h5 class="card-title my-2">Address</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $teacher->address }}" readonly></p>
                                                  <h5 class="card-title my-2">Birth date</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $teacher->dob }}" readonly></p>
                                                  <h5 class="card-title my-2">Gender</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $teacher->gender }}" readonly></p>
                                                  <h5 class="card-title my-2">Mobile Number</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $teacher->phone_number }}" readonly></p>
                                                </div>
                                              </div>
                                        </div>
                            
                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    @endforeach
                </tbody>
              </table>

        </div>
    </div>
    
@endsection