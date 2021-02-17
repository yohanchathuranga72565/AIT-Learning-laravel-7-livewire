@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $user-1 }}</h3>
  
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer p-3"> </i></a>
            </div>
          </div>
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $student }}</h3>
  
                <p>Student Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer p-3"></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $parent }}</h3>
  
                <p>Parent Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer p-3"></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $teacher }}</h3>
  
                <p>Teacher Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer p-3"></a>
            </div>
          </div>

          
    </div>
    <div class="row align-right">
        <div class="card bg-gradient-success">
            <div class="card-header border-0">

                <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            <div class="card-body pt-0">
                <div id="calendar" style="width: 100%"></div>
            </div>
        </div>
      
        
    </div>
</div>
@endsection
@section('script')
    <script>
    $( "#calendar" ).datepicker({
      showAnim:'drop',
      dateFormat:'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: "1970:2030",
    });
    </script>

@endsection

