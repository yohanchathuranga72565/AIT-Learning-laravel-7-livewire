@extends('layouts.app')

@section('content')
<!--================Form Area =================-->
<div class="container mb-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header text-center">{{ __('Course Payment Confirmation') }}</div>

                <div class="card-body">
                    <form method="POST" action="https://sandbox.payhere.lk/pay/checkout">
                        

                        <input type="hidden" name="merchant_id" value="1213607">    <!-- Replace your Merchant ID -->
                        <input type="hidden" name="return_url" value="http://localhost:8000/showCourses">
                        <input type="hidden" name="cancel_url" value="http://localhost:8000/showCourses">
                        <input type="hidden" name="notify_url" value="http://sample.com/notify">  
                        <br><br>Confirmation<br>
                        <input type="hidden" name="order_id" value="{{ $course[0]['id'] }}">
                        <input type="hidden" name="items" value="Course Payment"><br>
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" name="amount" class="form-control" value="{{ $course[0]['price'] }}">
                                <input type="text" name="amount" class="form-control" value="{{ $course[0]['price'] }}" disabled>    
                            </div>
                            <div class="col-6">
                                <input type="hidden" name="currency" value="LKR" >
                                <input type="text" name="currency_check" class="form-control" value="LKR" disabled>
                            </div>
                        </div>
                        
                        
                        
                        {{-- <br><br>Customer Details<br> --}}
                        <input type="hidden" name="first_name" value="asa">
                        <input type="hidden" name="last_name" value="asa">
                        <input type="hidden" name="email" value="asa">
                        <input type="hidden" name="phone" value="asa">
                        <input type="hidden" name="address" value="asa">
                        <input type="hidden" name="city" value="asa">
                        <input type="hidden" name="country" value="asa"><br>
                        <input type="submit" class="btn btn-sm btn-warning" value="Buy Now">   

                        {{-- <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required autocomplete="category">
                                    <option selected value="">Choose...</option>
                                        <option value="Mathematics"> Mathematics</option>
                                        <option value="ICT"> ICT</option>
                                        <option value="English"> English</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Choose Image') }}</label>
              
                            <div class="col-md-6">
                                <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image">
              
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Form Area =================-->
@endsection
