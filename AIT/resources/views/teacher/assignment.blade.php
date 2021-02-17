
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
                        <th scope="col">Grade</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $grade)
                            <tr>
                                <td scope="row">{{ $grade->grade }}</td>
    
                                <td class="text-right">
                                    <div>
                                        <a class="btn btn-sm btn-primary" href="{{ route('assignmentCreatedForm',$grade->id) }}" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> Add new assignment</a>
                                        <a class="btn btn-sm btn-primary" href="{{ route('viewSubmissions',[$grade->id,auth()->user()->teacher->id]) }}" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> View created assignment</a>
                                    </div>  
                                </td>
                                
                              
                                
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  
            </div>
        </div>
        <div class="row justify-content-center">
            {{ $grades->links() }}
        </div>
    </div>
    
@endsection