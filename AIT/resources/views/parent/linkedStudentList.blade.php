@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
          @if (Auth::user()->isA('administrator'))
            <h2>Parent related Child Accounts</h2>
          @endif
          @if (Auth::user()->isA('parent'))
            <h2>Your Child Accounts</h2>
          @endif
          
        </div>
        <div class="row justify-content-center">
            <table class="col-12 table table-hover table-sm table-responsive-lg">
                <thead class="thead-dark">
                  <tr class="text-center">
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                 
                  </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        {{-- view modal relate to the row --}}
                        <div class="modal fade" id="{{ 'profile'.$student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                          @if ($student->profile_image)
                                              <img src="{{asset('storage/profileImages/'.$student->profile_image)}}" class="rounded img-fluid" width='100%' alt="User Image"><br><br> 
                                          @else
                                              <img src="{{asset('storage/profileImages/profile.png')}}" class="rounded img-fluid" width='100%' alt="User Image">
                                          @endif    
                                      </div>
                                      <div class="col-12 mt-3">
                                          <div class="card">
                                              <div class="card-body">
                                                <h5 class="card-title my-2">Name</h5>
                                                <p class="card-text"><input type="text" class="form-control" value="{{ $student->name }}" readonly></p>
                                                <h5 class="card-title my-2">Email</h5>
                                                <p class="card-text"><input type="text" class="form-control" value="{{ $student->email }}" readonly></p>
                                                <h5 class="card-title my-2">Address</h5>
                                                <p class="card-text"><input type="text" class="form-control" value="{{ $student->address }}" readonly></p>
                                                <h5 class="card-title my-2">Grade</h5>
                                                <p class="card-text"><input type="text" class="form-control" value="{{ $student->grade->grade }}" readonly></p>
                                                <h5 class="card-title my-2">Birth date</h5>
                                                <p class="card-text"><input type="text" class="form-control" value="{{ $student->dob }}" readonly></p>
                                                <h5 class="card-title my-2">Gender</h5>
                                                <p class="card-text"><input type="text" class="form-control" value="{{ $student->gender }}" readonly></p>
                                                <h5 class="card-title my-2">Mobile Number</h5>
                                                <p class="card-text"><input type="text" class="form-control" value="{{ $student->phone_number }}" readonly></p>
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

                        <tr>
                            <th scope="row">{{ $student->id }}</th>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td class="text-right">
                              <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="{{ '#profile'.$student->id }}" ><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                              <a class="btn btn-sm btn-info" href="#" ><i class="fa fa-sm fa-book" aria-hidden="true"></i> Exam</a>
                              <a class="btn btn-sm btn-info" href="#" ><i class="fa fa-sm fa-check" aria-hidden="true"></i> Attendance</a>
                              <a class="btn btn-sm btn-warning" href="#" ><i class="fa fa-sm fa-credit-card" aria-hidden="true"></i> Class payment</a>
                            </td>
                        </tr>

                        {{-- view modal relate to the row --}}
                        {{-- <div class="modal fade" id="{{ 'profile'.$parent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                            @if ($parent->profile_image)
                                                <img src="{{asset('storage/profileImages/'.$parent->profile_image)}}" class="rounded img-fluid" width='100%' alt="User Image"><br><br> 
                                            @else
                                                <img src="{{asset('storage/profileImages/profile.png')}}" class="rounded img-fluid" width='100%' alt="User Image">
                                            @endif    
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="card">
                                                <div class="card-body">
                                                  <h5 class="card-title my-2">Name</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $parent->name }}" readonly></p>
                                                  <h5 class="card-title my-2">Email</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $parent->email }}" readonly></p>
                                                  <h5 class="card-title my-2">Address</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $parent->address }}" readonly></p>
                                                  <h5 class="card-title my-2">Birth date</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $parent->age }}" readonly></p>
                                                  <h5 class="card-title my-2">Gender</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $parent->gender }}" readonly></p>
                                                  <h5 class="card-title my-2">Mobile Number</h5>
                                                  <p class="card-text"><input type="text" class="form-control" value="{{ $parent->phone_number }}" readonly></p>
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
                          </div> --}}
                    @endforeach
                </tbody>
              </table>

        </div>
    </div>
    
@endsection