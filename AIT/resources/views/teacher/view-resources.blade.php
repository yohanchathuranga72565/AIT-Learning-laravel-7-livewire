
@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
          <h2>View resources</h2>
        </div>
        <div class="row justify-content-center">
            <table class="table table-hover table-sm table-responsive-sm">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Capter</th>
                    <th scope="col">Title</th>
                    <th scope="col">File Type</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($resources as $resource)
                        <tr>
                            <td scope="row">{{ $resource->capter }}</td>
                            <td scope="row">{{ $resource->title }}</td>
                            <td scope="row">{{ $resource->file }}</td>
                            <td>
                                <div >
                                    <a class="btn btn-sm btn-primary mt-1" href="#" > Edit</a>
                                    <a class="btn btn-sm btn-primary mt-1" href="#" > Change File</a>
                                    <a class="btn btn-sm btn-info mt-1" href="#" > View</a>
                                    <a class="btn btn-sm btn-danger mt-1" href="#" > Delete</a>
                                </div>
                            </td>

                            {{-- <td><a class="btn btn-sm btn-primary" href="{{ route('resourcesUploadForm',$grade->id) }}" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> Upload file</a></td>
                            <td><a class="btn btn-sm btn-primary" href="#" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> View resources</a></td>
                            <td><a class="btn btn-sm btn-danger" href="#" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
    
@endsection