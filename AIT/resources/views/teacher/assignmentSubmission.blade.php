@extends('layouts.app')


@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-12">
        <div class='p-2'>
            <a class="btn btn-sm btn-success" href="{{ route('downloadAllSUbmissions',$aid) }}" > Get All Submissions</a>
        </div>
       
        <table class="table table-hover table-sm table-responsive-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
                {{-- <th scope="col"></th> --}}
              </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $submission)
                    <tr>
                        <td scope="row">{{ $submission->student->name }}</td>
                        <td scope="row">{{ $submission->student->email }}</td>
                        

                        <td class="text-right">
                            {{-- <a class="btn btn-sm btn-primary" href="#" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> Mark attendance</a>
                            <a class="btn btn-sm btn-primary" href="{{ route('gradeStudent',$grade->id) }}" ><i class="fa fa-sm fa-user" aria-hidden="true"></i> Student</a>
                             --}}
                             <a class="btn btn-sm btn-success" href="{{ route('downloadOneSubmission',$submission->id) }}" ><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection