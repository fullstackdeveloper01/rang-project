@extends('layouts.front', ['class' => ''])

@section('content')
    @include('layouts.headers.search')
   <section class="section" id="main-content">
        <div class="container mt--100">
            @if(!empty($search_q))
                <h1>{{ "Search" }}:{{$search_q}}</h1>
            @else
                <h1>{{ "Recent View" }}</h1>
            @endif 
            
            <br />
            <div class="row">
                @if($images)
                @forelse ($images as $image)
                     
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="strip">
                            <figure>
                            <a href="{{ route('view_image', $image->id) }}"><img src="{{ asset('uploads') }}/{{ $image->logo }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" class="img-fluid lazy" alt=""></a>
                            </figure>
                            <!-- <span class="res_title"><b><a href="manufacturer/{{$image->user_id}}">{{ $image->username}}</a></b></span><br /> -->
                            <span class="res_description"><a href="{{ route('view_image', $image->id) }}">{{ $image->username }}</a></span><br />
                           

                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                    <p class="text-muted mb-0">{{ __('Hmmm... Nothing found!')}}</p>
                    </div>

                    @endforelse
                    
                    @else
                    <div class="col-md-12">
                    <p class="text-muted mb-0">{{ __('Hmmm... Nothing found!')}}</p>
                    </div>
                    @endif
            </div>
            @if(config('global.playstore') || config('global.appstore'))
            <hr>
            <div class="row row-grid align-items-center mb-5">
                <div class="col-lg-6">
                    <!--<h3 class="text-primary mb-2">{{ __('Download the food you love') }}</h3>
                    <h4 class="mb-0 font-weight-light">{{ __('It`s all at your fingertips - the restaurants you love') }}. {{ __ ('Find the right food to suit your mood, and make the first bite last') }}. {{ __('Go ahead, download us') }}.</h4>-->
                    <h3 class="text-primary mb-2">{{ __(config('global.mobile_info_title')) }}</h3>
                    <h4 class="mb-0 font-weight-light">{{ __(config('global.mobile_info_subtitle')) }}</h4>
                </div>
                <div class="col-lg-6 text-lg-center btn-wrapper">
                    <div class="row">
                        @if(config('global.playstore'))
                        <div class="col-6">
                            <a href="{{config('global.playstore')}}" target="_blank"><img class="img-fluid" src="/default/playstore.png" alt="..."/></a>
                        </div>
                        @endif
                        @if(config('global.appstore'))
                        <div class="col-6">
                            <a href="{{config('global.appstore')}}" target="_blank"><img class="img-fluid" src="/default/appstore.png" alt="..."/></a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection
