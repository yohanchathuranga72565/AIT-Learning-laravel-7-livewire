@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row justify-content-center my-2">
        @if (Auth::user()->isA('teacher'))
            <h2>Show your Course Lists</h2>
        @endif
        @if (Auth::user()->isA('student'))
            <h2>Buy Courses</h2>
        @endif
         
        </div>
        <div class="row justify-content-center my-2">
            <div class="col-md-8">
                @php
                        use App\Payment;
                        use App\Course;
                        use Illuminate\Http\Request;
                        if(isset($_GET['order_id'])){
                            $payments = Payment::where('course_id',$_GET['order_id'])->get('student_id');
                            $flag = 0;
                            foreach ($payments as $payment) {
                                if ($payment['student_id'] == auth()->user()->student->id) {
                                    $flag = 1;
                                }
                            }
                            if($flag == 0){
                                $course= Course::where('id',$_GET['order_id'])->get();
                                $payment = Payment::create(['amount'=>$course[0]['price'],'student_id'=>auth()->user()->student->id,'course_id'=>$_GET['order_id']]);
                                session()->flash('success', 'Payement successfully.');
                            }
                           
                            // return redirect(route('showCourse'))->with('success','Payement successfully.');
                        }
                    @endphp
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">  
                        {{ session()->get('success') }}
                        @php
                           session()->forget('success');
                        @endphp
                    </div>
                @endif
                <div class="col-6">
                    @if (Auth::user()->isA('teacher'))
                        <a href="{{ route("createCourse") }}"  class="btn btn-sm btn-primary"><i class="fa fa-sm fa-users" aria-hidden="true"></i> Add New Course</a>
                    @endif
                    
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
                    
                    @if ($_GET)
                        {{-- {{ $_GET['order_id'] }} --}}
                        {{-- <a href="{{ route("saveCoursePayment",$_GET['order_id']) }}" id='clicker'> --}}
                    @endif
                   
                    @foreach ($courses as $course)
                        @if (Auth::user()->isA('teacher'))
                            <div class="col-md-4  float-left pb-4">
                                <div class="card">
                                    @if (Auth::user()->isA('teacher|administrator'))
                                        <a href="{{ route("showCourseContent",$course->id) }}" class="lightbox">
                                    @else
                                        <a href="{{ route("coursePayment",$course->id) }}" class="lightbox">
                                    @endif
                                    
                                    
                                        <img src="{{asset('storage/course_image/'.$course->image)}}" alt="balcony" class="card-img-top zoom">
                                    </a>     
                                </div>
                
                                <div class="text-center">
                                    <div class="m-2">
                                        <h4>{{ $course->title }}</h4>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge rounded-pill bg-secondary">{{ $course->price }} LKR</span>
                                        @if (Auth::user()->isA('student'))
                                            @foreach ($course->payment as $payment )
                                                @if ($payment['student_id'] == Auth::user()->student->id)
                                                    <span class="badge rounded-pill bg-success">Paid</span>
                                                
                                                @endif
                                            @endforeach
                                    
                                                
                            
                                        @endif
                                    </div>
                                    @if (Auth::user()->isA('teacher'))
                                        <a href="{{ route('addCourseContent',$course->id) }}" class="btn btn-primary btn-sm">Add Content</a>
                                        @if ($course->publish == 1)
                                            <a href="{{ route("publishCourse",$course->id) }}" class="btn btn-primary btn-sm">Unpublish Course</a>
                                        @endif
                                        @if ($course->publish == 0)
                                            <a href="{{ route("publishCourse",$course->id) }}" class="btn btn-primary btn-sm">Publish Course</a>
                                        @endif
                                       
                                        <a href="" class="btn btn-danger btn-sm">Delete Course</a>
                                        
                                    @endif
                                
                                </div>
                            </div>
                        @else
                            @if ($course->publish == 1)
                                <div class="col-md-4  float-left pb-4">
                                    <div class="card">
                                        @if (Auth::user()->isA('teacher|administrator'))
                                            <a href="{{ route("showCourseContent",$course->id) }}" class="lightbox">
                                        @else
                                            {{-- <a href="{{ route("coursePayment",$course->id) }}" class="lightbox"> --}}
                                                @php
                                                    $flag = 0;
                                                @endphp
                                                @foreach ($course->payment as $payment )
                                                    @if ($payment['student_id'] == Auth::user()->student->id)
                                                        <a href="{{ route("showCourseContent",$course->id) }}" class="lightbox">
                                                        @php
                                                            $flag = 1;
                                                        @endphp
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if ($flag == 0)
                                                    <a href="{{ route("coursePayment",$course->id) }}" class="lightbox">
                                                @endif
                                        @endif
                                        
                                        
                                            <img src="{{asset('storage/course_image/'.$course->image)}}" alt="balcony" class="card-img-top zoom">
                                        </a>     
                                    </div>
                    
                                    <div class="text-center">
                                        <div class="m-2">
                                            <h4>{{ $course->title }}</h4>
                                        </div>
                                        <div class="mb-2">
                                            <span class="badge rounded-pill bg-secondary">{{ $course->price }} LKR</span>
                                            @if (Auth::user()->isA('student'))
                                                @foreach ($course->payment as $payment )
                                                    @if ($payment['student_id'] == Auth::user()->student->id)
                                                        <span class="badge rounded-pill bg-success">Paid</span>
                                                        @break
                                                    @endif
                                                @endforeach
                                        
                                                    
                                
                                            @endif
                                        </div>
                                        @if (Auth::user()->isA('teacher'))
                                            <a href="{{ route('addCourseContent',$course->id) }}" class="btn btn-primary btn-sm">Add Content</a>
                                            <a href="{{ route("publishCourse",$course->id) }}" class="btn btn-danger btn-sm">Publish Course</a>
                                            <a href="" class="btn btn-danger btn-sm">Delete Course</a>
                                            
                                        @endif
                                    
                                    </div>
                                </div>
                            @endif

                        @endif
                        
                    
                    @endforeach
                </div>
            </div>
        </div>
    </div> 
    <script>
    var button = document.getElementById('clicker');
    button.click();    
    </script> 
@endsection