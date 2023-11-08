@extends('layouts.front', ['class' => ''])
@include('restorants.partials.modals')

@section('content') 
@php

$openingTime ='';
@endphp
      

    <section class="section-profile-cover section-shaped grayscale-05 d-none d-md-none d-lg-block d-lx-block">
      <!-- Circles background -->
      <img class="bg-image" src="{{ $restorant->profile_image }}" style="width: 100%;">
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section section-lg pt-lg-0 mt--9 d-none d-md-none d-lg-block d-lx-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title white"  <?php if($restorant->description || $openingTime && $closingTime){echo 'style="border-bottom: 1px solid #f2f2f2;"';} ?> >
                        <h1 class="display-3 text-white">{{ $restorant->name }}</h1>
                        <p class="display-4" style="margin-top: 120px">{{ $restorant->description }}</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-12">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <section class="section section-lg d-md-block d-lg-none d-lx-none" style="padding-bottom: 0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h1 class="display-3 text">{{ $restorant->name }}</h1>
                        <p class="display-4 text">{{ $restorant->description }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg pt-lg-0" id="restaurant-content" style="padding-top: 0px">
        <div class="container container-restorant">

            <div class="row">
                <div class="col-md-6">
                    <h6 class="heading-small text-muted mb-4">{{ __('Request information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('user_request') }}" autocomplete="off"  enctype="multipart/form-data">
                            @csrf 
                            <input type="hidden" name="manufacturer_id" value="{{$restorant->id}}">
                            <input type="hidden" name="image_id" value="{{$restorant->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('image_size') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="image_size">{{ __('Images Size') }}</label>
                                        <input type="text" name="image_size" id="image_size" class="form-control form-control-alternative{{ $errors->has('image_size') ? ' is-invalid' : '' }}" placeholder="{{ __('Image size') }} ..." value="" required>
                                        @if ($errors->has('image_size'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image_size') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('image_quantity') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="image_quantity">{{ __('Images Quantity') }}</label>
                                        <input type="text" name="image_quantity" id="image_quantity" class="form-control form-control-alternative{{ $errors->has('image_quantity') ? ' is-invalid' : '' }}" placeholder="{{ __('Quantity......') }} ..." value="" required>
                                        @if ($errors->has('image_quantity'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image_quantity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group{{ $errors->has('pattern') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="pattern">{{ __('Images Pattern/Colors') }}</label>
                                        <input type="text" name="pattern" id="pattern" class="form-control form-control-alternative{{ $errors->has('pattern') ? ' is-invalid' : '' }}" placeholder="{{ __('Pattern/Colors...') }} ..." value="" required>
                                        @if ($errors->has('pattern'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pattern') }}</strong>
                                            </span>
                                        @endif
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     
                                        
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div> 
    </section>
@endsection
