@extends('layouts.appHome')
@section('contents')


	<!--================ Start Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="banner_inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="banner_content">
							<h2>
                                Achieve Your Goals with<br/>
                                AIT Institute
							</h2>
							<p>
                                Choose from many options including courses.<br/>
                                Learn at your own place.
							</p>
							<div class="search_course_wrap">
								<form action="" class="form_box d-flex justify-content-between w-100">
									<input type="text" placeholder="Search Courses" class="form-control" name="username" onfocus="this.placeholder = ''"
									 onblur="this.placeholder = 'Search Courses'">
									<button type="submit" class="btn search_course_btn">Search</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Home Banner Area =================-->

	<!--================ Start Feature Area =================-->
	<section class="feature_area">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-4">
					<div class="single_feature d-flex flex-row pb-30">
						<div class="icon">
							<span class="lnr lnr-book"></span>
						</div>
						<div class="desc">
							<h4>Online Classes</h4>
							<p>
								Join with us and learn very efficiently according to the new technology.
							</p>
						</div>
					</div>
					<div class="single_feature d-flex flex-row pb-30">
						<div class="icon">
							<span class="fa fa-trophy"></span>
						</div>
						<div class="desc">
							<h4>Top Courses</h4>
							<p>
								Further you can follow more courses online through our web site and get a valuable certificate.
							</p>
						</div>
					</div>
					<div class="single_feature d-flex flex-row">
						<div class="icon">
							<span class="lnr lnr-screen"></span>
						</div>
						<div class="desc">
							<h4>Online Resources</h4>
							<p>
								We provide many resources for your every subject.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Feature Area =================-->

	<!--================ Start Popular Courses Area =================-->
	<div class="popular_courses lite_bg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="main_title">
						<h2>Popular Courses</h2>
						<p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s
							exciting to think about setting up your own viewing station.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- single course -->
				{{-- <div class="col-lg-3 col-md-6">
					<div class="single_course">
						<div class="course_head overlay">
							<img class="img-fluid w-100" src="{{asset('homePages/img/courses/trainer1.jpg')}}" alt="">
							<div class="authr_meta">
								<img src="img/author1.png" alt="">
								<span>Mart Taylor</span>
							</div>
						</div>
						<div class="course_content">
							<h4>
								<a href="course-details.html">Learn React js beginners</a>
							</h4>
							<p>When television was young, there was a huge popular show based on the still popular fictional character of
								Superman.</p>
							<div class="course_meta d-flex justify-content-between">
								<div>
									<span class="meta_info">
										<a href="#"><i class="lnr lnr-user"></i>355</a>
									</span>
									<span class="meta_info">
										<a href="#">
											<i class="lnr lnr-bubble"></i>35
										</a>
									</span>
								</div>
								<div>
									<span class="price">$150</span>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
				<!-- single course -->
				{{-- <div class="col-lg-3 col-md-6">
					<div class="single_course">
						<div class="course_head overlay">
							<img class="img-fluid w-100" src="{{asset('homePages/img/courses/trainer1.jpg')}}" alt="">
							<div class="authr_meta">
								<img src="img/author1.png" alt="">
								<span>Mart Taylor</span>
							</div>
						</div>
						<div class="course_content">
							<h4>
								<a href="course-details.html">Learn React js beginners</a>
							</h4>
							<p>When television was young, there was a huge popular show based on the still popular fictional character of
								Superman.</p>
							<div class="course_meta d-flex justify-content-between">
								<div>
									<span class="meta_info">
										<a href="#">
											<i class="lnr lnr-user"></i>355
										</a>
									</span>
									<span class="meta_info"><a href="#">
											<i class="lnr lnr-bubble"></i>35
										</a></span>
								</div>
								<div>
									<span class="price df_color1">$150</span>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
				<!-- single course -->
				{{-- <div class="col-lg-3 col-md-6">
					<div class="single_course">
						<div class="course_head overlay">
							<img class="img-fluid w-100" src="{{asset('homePages/img/courses/trainer1.jpg')}}" alt="">
							<div class="authr_meta">
								<img src="img/author1.png" alt="">
								<span>Mart Taylor</span>
							</div>
						</div>
						<div class="course_content">
							<h4>
								<a href="course-details.html">Learn React js beginners</a>
							</h4>
							<p>When television was young, there was a huge popular show based on the still popular fictional character of
								Superman.</p>
							<div class="course_meta d-flex justify-content-between">
								<div>
									<span class="meta_info">
										<a href="#">
											<i class="lnr lnr-user"></i>355
										</a>
									</span>
									<span class="meta_info"><a href="#">
											<i class="lnr lnr-bubble"></i>35
										</a></span>
								</div>
								<div>
									<span class="price">$150</span>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
				<!-- single course -->
				{{-- <div class="col-lg-3 col-md-6">
					<div class="single_course">
						<div class="course_head overlay">
							<img class="img-fluid w-100" src="{{asset('homePages/img/courses/trainer1.jpg')}}" alt="">
							<div class="authr_meta">
								<img src="img/author1.png" alt="">
								<span>Mart Taylor</span>
							</div>
						</div>
						<div class="course_content">
							<h4>
								<a href="course-details.html">Learn React js beginners</a>
							</h4>
							<p>When television was young, there was a huge popular show based on the still popular fictional character of
								Superman.</p>
							<div class="course_meta d-flex justify-content-between">
								<div>
									<span class="meta_info">
										<a href="#">
											<i class="lnr lnr-user"></i>355
										</a>
									</span>
									<span class="meta_info"><a href="#">
											<i class="lnr lnr-bubble"></i>35
										</a></span>
								</div>
								<div>
									<span class="price df_color2">$150</span>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
            </div>
            {{-- <div class="container">
                <div class="row">
                    <div class="col text-right">
                        <a href="#" class="primary-btn text-uppercase">Explore Courses</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!--================ End Popular Courses Area =================-->
@endsection


