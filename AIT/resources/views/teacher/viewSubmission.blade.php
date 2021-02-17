
@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
          <h2>Assignments</h2>
        </div>
     
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-hover table-sm table-responsive-sm">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Due date</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                            <tr>
                                <td scope="row">{{ $assignment->title }}</td>
                                <td scope="row">{{ $assignment->due_date }}</td>
    
                                <td class="text-right">
                                    <div>
                                        <a class="btn btn-sm btn-primary" href="{{ route('submission',$assignment->id) }}" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> Submissions</a>
                                        <a class="btn btn-sm btn-primary" href="{{ route('editAssignmentForm',$assignment->id) }}" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> Edit</a>

                                        <a class="btn btn-sm btn-warning" href="{{ route('publishLink',$assignment->id) }}" >
                                            @if ($assignment->publish == 1)
                                                <i class="fa fa-sm fa-user" aria-hidden="true"></i> Unpublish
                                            @else
                                                <i class="fa fa-sm fa-user" aria-hidden="true"></i> Publish
                                            @endif
                                            
                                        </a>
                                    </div>  
                                </td>
                                
                              
                                
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  
            </div>
        </div>
        <div class="row justify-content-center">
            {{ $assignments->links() }}
        </div>
    </div>
    
@endsection