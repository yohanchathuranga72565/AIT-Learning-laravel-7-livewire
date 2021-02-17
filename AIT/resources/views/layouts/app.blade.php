
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AIT Institute | Dashboard</title>
  {{-- jquery --}}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="_token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminPanel/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('adminPanel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('adminPanel/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('adminPanel/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminPanel/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('adminPanel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('adminPanel/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('adminPanel/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Edit profile start -->

  @if (Auth::user()->isA('administrator'))
    @include('admin.editProfile')
    @include('admin.editImage')
  @elseif (Auth::user()->isA('student'))
    @include('student.editProfile')
    @include('student.editImage')
  @elseif(Auth::user()->isA('parent'))
    @include('parent.editProfile')
    @include('parent.editImage')
    @include('parent.linkStudentAcc')
  @elseif(Auth::user()->isA('teacher'))
    @include('teacher.editProfile')
    @include('teacher.editImage')
  @endif
<!-- Edit profile end -->

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('home.home')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('home.contact')}}" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      {{-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> --}}

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages -->
        <li class="nav-item dropdown">
          {{-- <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a> --}}
        </li>
        <li class="nav-item dropdown">
          <div id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="fa fa-cog" aria-hidden="true"></i> Setting <span class="caret"></span>
          </div>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#" data-toggle="modal" data-target=".edit-profile"><i class="fa fa-user" aria-hidden="true"></i> Edit profile Details</a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit-profile-image"><i class="fa fa-camera" aria-hidden="true"></i> Edit profile Image</a>
              <a class="dropdown-item" href="#"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
    <a href="{{route('home.home')}}" class="brand-link ml-3">
        <span class="brand-text font-weight-light">AIT Institute</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          @if (Auth::user()->isA('administrator'))

            @if (Auth::user()->admin->profile_image)
              <div class="image">
                <img src="{{asset('storage/profileImages/'.Auth::user()->admin->profile_image)}}" class="img-circle elevation-2" alt="User Image">
              </div>
            @else
              <div class="image">
                <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image">
              </div>
            @endif
            <div class="info">
              <a href="{{ route('admin.show',Auth::user()->admin->id) }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>

          @elseif (Auth::user()->isA('teacher'))

            @if (Auth::user()->teacher->profile_image)
              <div class="image">
                <img src="{{asset('storage/profileImages/'.Auth::user()->teacher->profile_image)}}" class="img-circle elevation-2" alt="User Image" >
              </div>
            @else
              <div class="image">
                <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image">
              </div>
            @endif
            <div class="info">
              <a href="{{ route('teacher.show',Auth::user()->teacher->id) }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>

          @elseif (Auth::user()->isA('student'))

            @if (Auth::user()->student->profile_image)
              <div class="image">
                <img src="{{asset('storage/profileImages/'.Auth::user()->student->profile_image)}}" class="img-circle elevation-2" alt="User Image">
              </div>
            @else
              <div class="image">
                <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image">
              </div>
            @endif
            <div class="info">
              <a href="{{ route('student.show',Auth::user()->student->id) }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>

          @elseif (Auth::user()->isA('parent'))

            @if (Auth::user()->parent->profile_image)
              <div class="image">
                <img src="{{asset('storage/profileImages/'.Auth::user()->parent->profile_image)}}" class="img-circle elevation-2" alt="User Image">
              </div>
            @else
              <div class="image">
                <img src="{{asset('storage/profileImages/profile.png')}}" class="img-circle elevation-2" alt="User Image">
              </div>
            @endif
            <div class="info">
              <a href="{{ route('parent.show',Auth::user()->parent->id) }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
            
          @endif
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->


            <li class="nav-item has-treeview menu-open">
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="@if (Auth::user()->isA('student'))
                    {{route('student.index')}}
                  @endif
                  @if (Auth::user()->isA('administrator'))
                    {{route('admin.index')}}
                  @endif
                  @if (Auth::user()->isA('parent'))
                    {{route('parent.index')}}
                  @endif
                  @if (Auth::user()->isA('teacher'))
                    {{route('teacher.index')}}
                  @endif" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                  </a>
                </li>
                
                @if (Auth::user()->isA('parent'))
                  <li class='nav-item'>
                    <a href="#" class='nav-link' data-toggle="modal" data-target="#linkStudentAcc">
                      <i class="nav-icon fa fa-link" aria-hidden="true"></i>
                      <p>Link your child</p>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a href="{{ route('getLinkedStudent',Auth::user()->parent->id) }}" class='nav-link'>
                      <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                      <p>Child reports and Payments</p>
                    </a>
                  </li>
            
                @endif
                

                
                {{-- account managment menu --}}
                @if (Auth::user()->isAn('administrator|teacher'))
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                      <i class="fa fa-user p-1" aria-hidden="true"></i>
                      <p class="pl-1">
                          Account managment
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                  
                  <ul class="nav nav-treeview">
                    @if (Auth::user()->isAn('administrator|teacher'))
                    <li class="nav-item">
                      <a href="{{ route('parentGetAllDetails') }}" class="nav-link">
                        <i class="far fa-circle nav-icon pl-2"></i>
                        <p>Parent</p>
                      </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('studentGetAllDetails') }}" class="nav-link">
                        <i class="far fa-circle nav-icon pl-2"></i>
                        <p>Student</p>
                      </a>
                    </li>
                    @endif
                    @if (Auth::user()->isAn('administrator'))
                    <li class="nav-item">
                      <a href="{{ route('teacherGetAllDetails') }}" class="nav-link">
                        <i class="far fa-circle nav-icon pl-2"></i>
                        <p>Teacher</p>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
                @endif
                @if (Auth::user()->isA('student|teacher'))
                  <li class='nav-item'>
                    <a href="{{ route('comments') }}" class="nav-link">
                      <i class="nav-icon fa fa-comment" aria-hidden="true"></i>
                      <p>Comment Section</p>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a href="{{ route('showCourse') }}" class="nav-link">
                      <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                      <p>Show Courses</p>
                    </a>
                  </li>
                @endif
                @if (Auth::user()->isA('teacher'))
                  <li class='nav-item'>
                    <a href="{{ route('showClasses') }}" class="nav-link">
                      <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                      <p>Classes</p>
                    </a>
                  </li>
                  {{-- <li class='nav-item'>
                    <a href="{{ route('attendanceShowClasses') }}" class="nav-link">
                      <i class="nav-icon fa fa-address-card" aria-hidden="true"></i>
                      <p>Attendance</p>
                    </a>
                  </li> --}}
                  <li class='nav-item'>
                    <a href="{{ route('resourcesShowClasses') }}" class="nav-link">
                      <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                      <p>Resources</p>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a href="{{ route('assignmentsShowClasses') }}" class="nav-link">
                      <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                      <p>Assignments</p>
                    </a>
                  </li>
                 
                  
                @endif
                @if (Auth::user()->isA('student'))
                  <li class='nav-item'>
                    <a href="{{ route('showSubjects') }}" class="nav-link">
                      <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                      <p>Subjects</p>
                    </a>
                  </li>
                @endif
          </ul> 
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    {{-- <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
      </div>
    </footer> --}}

    <!--================ Start footer Area  =================-->
    <footer class="main-footer">
      <strong>Copyright © 2020 AIT Institute All rights reserved</strong>
      <div class="float-right d-none d-sm-inline-block">
        
      </div>
    </footer>
    <!--================ End footer Area  =================-->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="{{asset('adminPanel/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminPanel/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminPanel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('adminPanel/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminPanel/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('adminPanel/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('adminPanel/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminPanel/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('adminPanel/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminPanel/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('adminPanel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('adminPanel/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminPanel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminPanel/dist/js/adminlte.js')}}"></script>
{{-- jquery ui --}}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous"></script>
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

    $( "#dobParent" ).datepicker({
      maxDate:new Date(),
      showAnim:'drop',
      dateFormat:'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: "1970:2030",
    });

    $( "#dobStudent" ).datepicker({
      maxDate:new Date(),
      showAnim:'drop',
      dateFormat:'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: "1970:2030",
    });

    $( "#dobTeacher" ).datepicker({
      maxDate:new Date(),
      showAnim:'drop',
      dateFormat:'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: "1970:2030",
    });

    $( "#dueDate" ).datepicker({
      minDate:new Date(),
      showAnim:'drop',
      dateFormat:'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: "1970:2030",
    });

    $( "#dueDate1" ).datepicker({
      minDate:new Date(),
      showAnim:'drop',
      dateFormat:'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: "1970:2030",
    });
  } );
</script>
@yield('script')

@livewireScripts


</body>
</html>
