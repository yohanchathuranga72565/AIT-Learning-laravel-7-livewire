@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
          <h2>Classes</h2>
        </div>
        <div class="row justify-content-center my-2">
          <div class="col-6">
            <a href="#" data-toggle="modal" data-target="#addSubject" class="btn btn-sm btn-primary"><i class="fa fa-sm fa-book" aria-hidden="true"></i> Get Permission for Subjects</a>
          </div>
          <div class="col-6">
              {{-- can write something --}}
          </div>
        </div>
        {{-- student modal relate to the row --}}
        <div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="example" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('getPermisionSubject') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="example">Get Permission for SUbjects</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="row justify-content-center">
                            @if (!count($teachers[0])==0)
                                @foreach ($teachers[0] as $teacher)
                                    <div class="col-12 text-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="selected[]" value="{{ $teacher->id }}"
                                            @foreach ($teachers[1] as $select)
                                                @if ($select->id == $teacher->subject->id)
                                                    disabled
                                                @endif
                                            @endforeach
                                            >
                                            <label class="form-check-label" for="selected[]">{{ $teacher->name }} ({{ $teacher->subject->name }})</label>
                                        </div>
                                    </div>  
                                @endforeach
                            @else
                                <div class="col-12 text-center">
                                    <div class="form-check form-check-inline">
                                        <p>No any teachers for your grade</p>
                                    </div>
                                </div>  
                            @endif
                            
                            
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table table-hover table-sm table-responsive-sm">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Subject</th>
                    <th scope="col">Teacher</th>
                    <th scope="col"></th>
                    
                  </tr>
                </thead>
                <tbody>
                    
                    @foreach ($teachers[0] as $teacher)
                        @foreach($teachers[1] as $subjects)
                        @if ($subjects->name == $teacher->subject->name )
                        <tr>
                            <td scope="row">{{ $subjects->name }}</td>
                            <td scope="row">{{ $teacher->name }}</td>

                            <td class="text-right"><a class="btn btn-sm btn-primary" href="{{ route('viewResources',[auth()->user()->student->grade,$teacher->id]) }}" ><i class="fa fa-sm fa-book" aria-hidden="true"></i> Get Resources</a>
                            <a class="btn btn-sm btn-primary" href="{{ route('assignments',$teacher->id) }}" ><i class="fa fa-sm fa-book" aria-hidden="true"></i> Assignments</a></td>
                            {{-- <td><a class="btn btn-sm btn-danger" href="#" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td> --}}
                        </tr>
                        @endif
                        @endforeach
                    @endforeach
                
                </tbody>
              </table>
        </div>
    </div>
    
@endsection