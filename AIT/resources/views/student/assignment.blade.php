@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
            <h2>Assignments</h2>
        </div>
        <div class="row justify-content-center my-2">
            <div class="col-md-8">
               
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">  
                        {{ session()->get('success') }}
                        @php
                           session()->forget('success');
                        @endphp
                    </div>
                @endif
                <div class="col-6">
      
                </div>
                <div class="col-6">
                    {{-- can write something --}}
                </div>
            </div> 
        </div>
    </div>

     <!-- course list start-->
    <div class="container">
        <div class="container">
            <div>
                <div class="row">

                    @foreach ($assignments as $assignment)
                            @if ($assignment->publish == 1)
                                <div class="col-md-4  float-left pb-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>{{ $assignment->title }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Description</h5>
                                            <p class="card-text">{{ $assignment->description }}</p>
                                            <div class="bg-info p-1">
                                                <h6>Your assignment Instruction</h6>
                                                <a href="{{ route('assignmentView',$assignment->file) }}" class=""><i class="fas fa-file-pdf"></i> {{ $assignment->file }}</a><br/>
                                            </div>
                                            
                                            <h6>Due Date: {{ $assignment->due_date }}</h6>
                                            <h6>Due Time: 12.00 AM</h6>
                                            <div>
                                                @if ($answers)
                                                    @foreach ($answers as $answer)
                                                        @if ($answer->assignment_id == $assignment->id)
                                                            <div class="alert alert-success fade show" role="alert">
                                                                Submitted
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    
                                                @endif
                                            </div>
                                        
                                        </div>
                                        <div class="card-footer">
                                                @if ($assignment->due_date < date('Y-m-d'))
                                                <div class="alert alert-danger fade show" role="alert">
                                                    You can't upload, Overdue
                                                </div>
                                                @else 
                                                    <a href="{{ route('uploadAssignment',$assignment->id) }}" class="btn btn-primary">Upload answer</a>
                                                @endif
                                            
                                        </div>
                    
                                        </a>     
                                    </div>
                                </div>
                            @endif
                            
                    @endforeach
                </div>
            </div>
        </div>
    </div> 
@endsection