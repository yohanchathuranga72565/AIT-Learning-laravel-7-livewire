@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-5">
            @livewire('questions')
        </div>
        <div class="col-12 col-md-5">
            @livewire('comments')
        </div>  
    </div>
    
@endsection