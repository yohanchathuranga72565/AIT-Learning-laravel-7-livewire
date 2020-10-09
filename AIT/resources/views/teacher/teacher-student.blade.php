
@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
          <h2>View Your Student Lists</h2>
          {{-- <div class="col-12 mt-3">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">  
                    {{ session()->get('success') }}
                </div>
            @endif
          </div> --}}
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-sm table-responsive-sm">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td scope="row">{{ $student->id }}</td>
                            <td scope="row">{{ $student->name }}</td>
                            <td scope="row">{{ $student->email }}</td>
                            <td scope="row">{{ $student->grade->grade }}</td>
                            <td class="text-right">
                                <div >
                                    <a class="btn btn-sm btn-primary mt-1" href="#" >Attendance</a>
                                    <a class="btn btn-sm btn-primary mt-1" href="#" > Exam Report</a>
                                    <a class="btn btn-sm btn-info mt-1" href="#" data-toggle="modal" data-target="{{ '#profile'.$student->id }}"> View</a>
                                    {{-- <a class="btn btn-sm btn-danger mt-1" href="#" onclick="return confirm('Are you sure?')"> Delete</a> --}}
                                </div>
                            </td>
                        </tr>
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
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            {{ $students->links() }}
        </div>
    </div>
    
@endsection