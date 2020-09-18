<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{asset('homePages/img/favicon.png')}}" type="image/png">
	<title>AIT Institute</title>
	{{-- jquery --}}
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('css/app.css') }}">
	<link rel="stylesheet" href="{{asset('homePages/vendors/linericon/style.css')}}">
	<link rel="stylesheet" href="{{asset('homePages/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('homePages/vendors/owl-carousel/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('homePages/vendors/lightbox/simpleLightbox.css')}}">
	<link rel="stylesheet" href="{{asset('homePages/vendors/nice-select/css/nice-select.css')}}">
	<link rel="stylesheet" href="{{asset('homePages/vendors/animate-css/animate.css')}}">
	<!-- main css -->
	<link rel="stylesheet" href="{{asset('homePages/css/style.css')}}">
</head>

<body>
    <!--================ Start Header Menu Area =================-->
	<header class="header_area">
		<div class="header-top">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-8 col-sm-8 col-4 header-top-left">
						<a href="tel:+9530123654896">
							<span class="lnr lnr-phone"></span>
							<span class="text">
								<span class="text">+94 77 068 3621</span>
							</span>
						</a>
						<a href="mailto:support@colorlib.com">
							<span class="lnr lnr-envelope"></span>
							<span class="text">
                                <span class="text">academyit@gmail.com</span>
							</span>
                        </a>
					</div>
					<div class="col-lg-4 col-sm-4 col-8 header-top-right">
                        @guest
                            <a href="{{ route('login') }}" class="text-uppercase">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-uppercase">Register</a>
                            @endif
                        @else
                            <div class="nav-item dropdown">
                                <div id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                	</div>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
									</form>
									
                                </div>
                            </div>
                        @endguest
					</div>
				</div>
			</div>
		</div>

		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="{{route('home.home')}}"><img src="{{asset('homePages/img/AITlogo.png')}}" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item @if(session()->has('home')) active @endif"><a class="nav-link" href="{{route('home.home')}}">Home</a></li>
							<li class="nav-item @if(session()->has('about')) active @endif"><a class="nav-link" href="{{route('home.about')}}">About</a></li>
							<li class="nav-item @if(session()->has('contact')) active @endif"><a class="nav-link" href="{{route('home.contact')}}">Contact</a></li>
							@auth
								@if (Auth::user()->isA('student'))
									<li class="nav-item"><a class="nav-link" href="{{route('student.index')}}">Dashboard</a></li>
								@endif
								@if (Auth::user()->isA('administrator'))
									<li class="nav-item"><a class="nav-link" href="{{route('admin.index')}}">Dashboard</a></li>
								@endif
								@if (Auth::user()->isA('parent'))
									<li class="nav-item"><a class="nav-link" href="{{route('parent.index')}}">Dashboard</a></li>
								@endif
								@if (Auth::user()->isA('teacher'))
									<li class="nav-item"><a class="nav-link" href="{{route('teacher.index')}}">Dashboard</a></li>
								@endif
							@endauth
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================ End Header Menu Area =================-->
    @yield('contents')
	<!--================ Start footer Area  =================-->
	<hr>
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-6 single-footer-widget">
                    <h2 class="text-white">Links</h2>
                    <ul>
                        <li><a href ="{{route('home.home')}}">Home</a></li>
                        <li><a href ="{{route('home.about')}}">About</a></li>
                        <li><a href ="{{route('home.contact')}}">Contact</a></li>
                    </ul>
				</div>
				<div class="col-lg-4 col-md-6 single-footer-widget">
                    <h2  class="text-white">Location</h2>
                    <address class="address">
                        AIT Institute,<br>
                        Kumarakanda<br>
                        Dodanduwa<br>
                        <i class="fa fa-phone fa-lg"></i> Tel.: +94 77 068 3621<br>
                        {{-- <i class="fa fa-fax fa-lg"></i> Fax: +852 8765 4321<br> --}}
                        <i class="fa fa-envelope fa-lg"></i> Email: <a href="mailto:confusion@food.net">academyit@gmail.com</a><br>
                        <i class="fa fa-envelope fa-lg"></i> Email: <a href="mailto:confusion@food.net">nadith_manawadu@yahoo.com</a>

                     </address>
				</div>
				<div class="col-lg-6 col-md-12 single-footer-widget">
                    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=18lxxp05IH8Upok9t_mhCCctDUC9KxQNr" width="100%" height="300"></iframe>
				</div>

			</div>
			<div class="row footer-bottom d-flex justify-content-between">
				<p class="col-lg-8 col-sm-12 footer-text m-0">Copyright © 2020 AIT Institute All rights reserved</p>
				<div class="col-lg-4 col-sm-12 footer-social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-dribbble"></i></a>
					<a href="#"><i class="fa fa-behance"></i></a>
				</div>
            </div>
           </div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('css/app.js') }}"></script>
	<script src="{{asset('homePages/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('homePages/js/popper.js')}}"></script>
	<script src="{{asset('homePages/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('homePages/js/stellar.js')}}"></script>
	<script src="{{asset('homePages/js/countdown.js')}}"></script>
	<script src="{{asset('homePages/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('homePages/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('homePages/js/owl-carousel-thumb.min.js')}}"></script>
	<script src="{{asset('homePages/js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('homePages/vendors/counter-up/jquery.counterup.js')}}"></script>
	<script src="{{asset('homePages/js/mail-script.js')}}"></script>
	{{-- jquery ui --}}
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$( function() {
			$( "#dob" ).datepicker({
			maxDate:new Date(),
			showAnim:'drop',
			dateFormat:'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "1970:2030",
			});
		} );
	</script>
</body>

</html>
