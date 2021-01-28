@extends('layouts.appHome')
@section('contents')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="banner_content text-center">
                            <h2>About Us</h2>
                            <p>AIT Institute is a leading institute which provides vast range of facilities to students using new technology</p>
                            <div class="page_link">
                                <a href="{{route('home.home')}}">Home</a>
                                <a href="#">About</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================ Start Department Area =================-->
    <div class="department_area section_gap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center">
                    <img class="img-fluid" src="{{asset('homePages/img/about-img.png')}}" alt="">
                </div>

                <div class="offset-lg-1 col-lg-5">
                    <div class="dpmt_right">
                        <h3>Number of subject-related courses to expand your knowledge</h3>
                        <p>We have provided number of courses as a benefaction to develop your knowledge. And we are looking forward to provide more online courses which includes substantial content.</p><br/>
                        <p>We offer convenient, affordable online and video classes that allow you to obtain and maintain your licensure on your time, at your own pace. These classes are offered by the very skilled teachers and can help you in developing new skills and techniques. New classes added regularly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Department Area =================-->

    <!--================ Start Instructor Area =================-->
    <div class="instructors_area lite_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="main_title">
                        <h2>Our Teachers</h2>
                        <p>We have very skilled teachers for guiding you to a best way. They help you frequently to improving your skill and knowledge. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- single-instructor -->
                @foreach ($teachers as $teacher)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single_instructor">
                            <div class="author">
                                @if ($teacher->profile_image)
                                    <img src="{{asset('storage/profileImages/'.$teacher->profile_image)}}" alt="" width ='163' height='163'>
                                @else
                                    <img src="{{asset('storage/profileImages/profile.png')}}" alt="" width ='163' height='163'>
                                @endif
                                
                            </div>
                            <div class="author_decs">
                                <h4>{{ $teacher->name }}</h4>
                                <p class="profession">{{ $teacher->subject->name }}</p>
                                {{-- <p>If you are looking at blank cassettes on the web, you may be very confused at the
                                    difference in price.</p> --}}
                                <div class="social_icons">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-lg-3 col-sm-6">
                    <div class="single_instructor">
                        <div class="author">
                            <img src="{{asset('homePages/img/instructors/ins1.jpg')}}" alt="">
                        </div>
                        <div class="author_decs">
                            <h4>Ethel Davis</h4>
                            <p class="profession">Sr. Faculty Data Science</p>
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the
                                difference in price.</p>
                            <div class="social_icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                
                {{-- <!-- single-instructor -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single_instructor">
                        <div class="author">
                            <img src="{{asset('homePages/img/instructors/ins2.jpg')}}" alt="">
                        </div>
                        <div class="author_decs">
                            <h4>Rodney Cooper</h4>
                            <p class="profession">Sr. Faculty Data Science</p>
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the
                                difference in price.</p>
                            <div class="social_icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single-instructor -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single_instructor">
                        <div class="author">
                            <img src="{{asset('homePages/img/instructors/ins3.jpg')}}" alt="">
                        </div>
                        <div class="author_decs">
                            <h4>Dane Walker</h4>
                            <p class="profession">Sr. Faculty Data Science</p>
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the
                                difference in price.</p>
                            <div class="social_icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single-instructor -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single_instructor">
                        <div class="author">
                            <img src="{{asset('homePages/img/instructors/ins4.jpg')}}" alt="">
                        </div>
                        <div class="author_decs">
                            <h4>Lena Keller</h4>
                            <p class="profession">Sr. Faculty Data Science</p>
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the
                                difference in price.</p>
                            <div class="social_icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!--================ End Instructor Area =================-->
@endsection

