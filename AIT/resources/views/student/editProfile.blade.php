<div class="modal fade edit-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('student.update',Auth::user()->id)}}">
                @csrf
                @method('patch')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{Auth::user()->student->address}}" required autocomplete="address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="p_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                        <div class="col-md-6">
                            <input id="pno" type="text" class="form-control @error('pno') is-invalid @enderror" name="pno" value="{{Auth::user()->student->phone_number}}" required autocomplete="pno">

                            @error('pno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                        <div class="col-md-6">
                        <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{Auth::user()->student->gender}}" readonly required autocomplete="pno">
            
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                        <div class="col-md-6">
                            <input id="dob" type="text" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{Auth::user()->student->dob}}" required autocomplete="dob">

                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- <div class="form-group row">
                        <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                        <div class="col-md-6">
                            <select id="grade" type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ old('grade') }}" required autocomplete="grade">
                                <option>Choose...</option>
                                <option @if (Auth::user()->student->age=="Grade 1") selected @endif>Grade 1</option>
                                <option @if (Auth::user()->student->age=="Grade 2") selected @endif>Grade 2</option>
                                <option @if (Auth::user()->student->age=="Grade 3") selected @endif>Grade 3</option>
                                <option @if (Auth::user()->student->age=="Grade 4") selected @endif>Grade 4</option>
                                <option @if (Auth::user()->student->age=="Grade 5") selected @endif>Grade 5</option>
                                <option @if (Auth::user()->student->age=="Grade 6") selected @endif>Grade 6</option>
                                <option @if (Auth::user()->student->age=="Grade 7") selected @endif>Grade 7</option>
                                <option @if (Auth::user()->student->age=="Grade 8") selected @endif>Grade 8</option>
                                <option @if (Auth::user()->student->age=="Grade 9") selected @endif>Grade 9</option>
                                <option @if (Auth::user()->student->age=="Grade 10") selected @endif>Grade 10</option>
                                <option @if (Auth::user()->student->age=="Grade 11(O/L)") selected @endif>Grade 11(O/L)</option>
                                <option @if (Auth::user()->student->age=="Grade 12(A/L)") selected @endif>Grade 12(A/L)</option>
                                <option @if (Auth::user()->student->age=="Grade 13(A/L)") selected @endif>Grade 13(A/L)</option>
                            </select>
                            @error('grade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>