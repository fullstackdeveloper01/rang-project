@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <!--<div class="text-center text-muted mb-4">
                            <small>{{ __('Or sign up with credentials') }}</small>
                        </div>-->
                        <form role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="current-form">

                                <div class="sform-group{{ $errors->has('role') ? ' has-danger' : '' }} mb-3 text-center">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" value="1" @if(old('role') == 1) checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Manufacturer
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2" value="0" @if(old('role') == 0 || old('role') == "") checked @endif >
                                            <label class="form-check-label" for="flexRadioDefault2">
                                            Buyer 
                                            </label>
                                    </div>
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Company Name') }}" type="text" name="company_name" value="{{ old('company_name') }}" required>
                                    </div>
                                    @if ($errors->has('company_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('company_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('company_address') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" placeholder="{{ __('Company Address') }}" type="text" name="company_address" value="{{ old('company_address') }}" required>
                                    </div>
                                    @if ($errors->has('company_address'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('company_address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('gst_number') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('gst_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Company GST Number') }}" type="text" name="gst_number" value="{{ old('gst_number') }}" required>
                                    </div>
                                    @if ($errors->has('gst_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('gst_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" type="phone" name="phone" value="{{ old('phone') }}" required>
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
                                    </div>
                                </div>
    
                                <div class="form-group{{ $errors->has('profile_image') ? ' has-danger' : '' }}">
                                    <?php
                                        $image= ['name'=>'profile_image','label'=>__('Profile Image'),'value'=>'','style'=>'width: 200px;'];
                                    ?>
                                    @include('partials.images',$image)
                                    @if ($errors->has('profile_image'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('profile_image') }}</strong>
                                        </span>
                                    @endif
                                </div>  

                                <div class="text-center next-btn" style="display:@if(old('role') == 1) block @else none  @endif;">
                                    <button type="button" class="btn btn-primary mt-4 next-sb-btn">{{ __('Next') }}</button>
                                </div> 

                            </div>
                            <div class="next-manufacturer ">

                                <div class="form-group ">
                                    <div class="form-group text-center">
                                        <label class="form-control-label" for="input-name">Materials</label>
                                    
                                        <div class="input-group input-group-alternative">
                                        <select class="form-control" name="material[]" id="material" multiple> 
                                            @if($materials)
                                                @foreach($materials as $key => $data)
                                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                                @endforeach
                                            @endif                                        
                                        </select>
                                    </div>
                                    </div>
                                </div>

                            </div> 

                            <div class="text-center sbmit-btn" @if(old('role') == 1) style="display:none;" @endif>
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-light">
                                <small>{{ __('Forgot password?') }}</small>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('login') }}" class="text-light">
                            <small>{{ __('Back to login') }}</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .next-manufacturer{
            display: nones;
        }
        </style>
@endsection
@section('js')
    <script>  

        $(document).ready(function() {
            setTimeout(() => {
                $('.next-manufacturer').hide();
            }, 500);
            $('#material').select2({
                placeholder: 'Please select material',
                multiple:true,
                maximumSelectionLength : 3
            });

            
        });

        $(document).on('click', '.next-sb-btn',function() {
            $('.current-form').hide();
            $('.next-manufacturer').show();
            $('.sbmit-btn').show();
            
        });

        $(document).on('change', 'input[name="role"]',function() { 
            var role = $(this).val();
            if(role == 1)
            {
                $('.sbmit-btn').hide();
                $('.next-btn').show();
            }else{
                $('.next-btn').hide();
                $('.sbmit-btn').show();
            }
        } )
        
    </script>

@endsection