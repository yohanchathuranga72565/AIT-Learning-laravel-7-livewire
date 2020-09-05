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
                            <h2>Contact Us</h2>
                            <p>Whether you have question about anything. AIT Institute is ready to answer all your questions.</p>
                            <div class="page_link">
                                <a href="{{route('home.home')}}">Home</a>
                                <a href="#">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="contact_info">
                        <div class="info_item mb-3">
                            <i class="lnr lnr-home"></i>
                            <h6>AIT Institute<br>
                                Kumarakanda<br>
                                Dodanduwa<br></h6>
                            {{-- <p>Santa monica bullevard</p> --}}
                        </div>
                        <div class="info_item mb-3">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6><a href="#">Tel.: +94 77 068 3621</a></h6>
                            {{-- <p>Mon to Fri 9am to 6 pm</p> --}}
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6><a href="#">academyit@gmail.com</a></h6>
                            {{-- <p>Send us your suggetion anytime!</p> --}}
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6><a href="#">nadith_manawadu@yahoo.com</a></h6>
                            {{-- <p>Send us your suggetion anytime!</p> --}}
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    @if (session()->has('sentmail'))
                        <div class="alert alert-success">
                            {{session()->get('sentmail')}}
                        </div>
                    @endif
                    <form class="row contact_form" action="{{route('contact-mail')}}" method="post" id="contactForm">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email address">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Enter Subject">
                                @error('subject')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="1" placeholder="Enter Message"></textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" value="submit" class="btn primary-btn">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->
@endsection
