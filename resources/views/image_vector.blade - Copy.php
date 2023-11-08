@extends('layouts.front', ['class' => ''])
@include('restorants.partials.modals')

@section('content') 
@php

$openingTime ='';
@endphp
      
<style>
			.flickity-enabled {
  position: relative;
}

.flickity-enabled:focus {
  outline: none;
}

.flickity-viewport {
  overflow: hidden;
  position: relative;
  height: 100%;
}

.flickity-slider {
  position: absolute;
  width: 100%;
  height: 100%;
}

/* draggable */

.flickity-enabled.is-draggable {
  -webkit-tap-highlight-color: transparent;
  tap-highlight-color: transparent;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.flickity-enabled.is-draggable .flickity-viewport {
  cursor: move;
  cursor: -webkit-grab;
  cursor: grab;
}

.flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
  cursor: -webkit-grabbing;
  cursor: grabbing;
}

/* ---- previous/next buttons ---- */

.flickity-prev-next-button {
  position: absolute;
  top: 50%;
  width: 44px;
  height: 44px;
  border: none;
  border-radius: 50%;
  background: white;
  background: hsla(0, 0%, 100%, 0.75);
  cursor: pointer;
  /* vertically center */
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
}

.flickity-prev-next-button:hover {
  background: white;
}

.flickity-prev-next-button:focus {
  outline: none;
  box-shadow: 0 0 0 5px #09f;
}

.flickity-prev-next-button:active {
  opacity: 0.6;
}

.flickity-prev-next-button.previous {
  left: 10px;
}
.flickity-prev-next-button.next {
  right: 10px;
}
/* right to left */
*/
/* .flickity-rtl .flickity-prev-next-button.previous { */
/*   left: auto; */
/*   right: 10px; */
/* } */
/* .flickity-rtl .flickity-prev-next-button.next { */
/*   right: auto; */
/*   left: 10px; */
/* } */

.flickity-prev-next-button:disabled {
  opacity: 0.3;
  cursor: auto;
}

.flickity-prev-next-button svg {
  position: absolute;
  left: 20%;
  top: 20%;
  width: 60%;
  height: 60%;
}

.flickity-prev-next-button .arrow {
  fill: #333;
}

/* ---- page dots ---- */

/* .flickity-page-dots { */
/*   position: absolute; */
/*   width: 100%; */
/*   bottom: -25px; */
/*   padding: 0; */
/*   margin: 0; */
/*   list-style: none; */
/*   text-align: center; */
/*   line-height: 1; */
/* } */
/*  */
/* .flickity-rtl .flickity-page-dots { direction: rtl; } */
/*  */
/* .flickity-page-dots .dot { */
/*   display: inline-block; */
/*   width: 10px; */
/*   height: 10px; */
/*   margin: 0 8px; */
/*   background: #333; */
/*   border-radius: 50%; */
/*   opacity: 0.25; */
/*   cursor: pointer; */
/* } */
/*  */
/* .flickity-page-dots .dot.is-selected { */
/*   opacity: 1; */
/* } */

/* end external css: flickity.css */
/*! Flickity v2.0.4
https://flickity.metafizzy.co
---------------------------------------------- */

* {
  box-sizing: border-box;
}

body {
  font-family: sans-serif;
}

.carousel {
  background: #fafafa;
}

.carousel-main {
  margin-bottom: 8px;
}

.carousel-cell {
  width: 100%;
  height: 503px;
  margin-right: 8px;
  background: #fff;
  border-radius: 5px;
  /* counter-increment: carousel-cell; */
}

/* cell number */
/* .carousel-cell:before { */
/*   display: block; */
/*   text-align: center; */
/*   content: counter(carousel-cell); */
/*   line-height: 200px; */
/*   font-size: 80px; */
/*   color: white; */
/* } */

.carousel-nav .carousel-cell {
  height: 90px;
  width: 120px;
}

/* .carousel-nav .carousel-cell:before { */
/*   font-size: 50px; */
/*   line-height: 80px; */
/* } */

/* .carousel-nav .carousel-cell.is-nav-selected { */
/*   background: #ED2; */
/* } */

/* Atelierbram edit */
.carousel-main img {
  display: block;
  margin: 0 auto;
  object-fit: scale-down;
  height:100%;
}
#hubblepic {
  width: 100%;
}

#zoomer {
  display: block;
  width: 50%;
  margin: 2rem auto;
}
.carousel-cell div{
	height: 100%;
    width: 54%;
    margin: 0px auto;
}
@media all and (max-width: 500px) {
  #zoomer {
    width: 85%;
  }
}
		</style>
    <section class="section-profile-cover section-shaped grayscale-05 d-none d-md-none d-lg-block d-lx-block">
      <!-- Circles background -->
      <img class="bg-image" src="{{ asset('uploads') }}/{{ $restorant->logo }}&quot;" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" style="width: 100%;">
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
                        <h1 class="display-3 text-white">{{ $restorant->username }}</h1> 
                       
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <section class="section section-lg d-md-block d-lg-none d-lx-none" style="padding-bottom: 0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h1 class="display-3 text">{{ $restorant->username }}</h1> 
                        
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <section class="section section-lg pt-lg-0" id="restaurant-content" style="padding-top: 0px">

        <div class="container container-restorant">
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">
                    <div class="strip">
                        <figure>
                        <img src="{{ asset('uploads') }}/{{ $restorant->logo }}&quot;" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" class="img-fluid lazy" alt="">
                        </figure> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="text-center">
                @csrf 
                    <button type="button" date-image="{{ $restorant->id }}" class="btn btn-success mt-4 addToCart">{{ __('Add To Cart') }}</button>
                </div>
            </div>

            <!-- <div class="row">
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
            </div>  -->
        </div>
    </section>
    <section>
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-12">
							<!-- Flickity HTML init -->
							<div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
								<div class="carousel-cell">
									<div id="hubblepic1" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">
										<img  class="img-fluid w-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/summer-outfit-mockup-with-female-model.png" alt="Product">
									</div>
								</div>
								<div class="carousel-cell ">
									<div id="hubblepic2" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">
										<img  class="img-fluid w-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/Women_dress_tees_mockup.png"  alt="Product">
									</div>
								</div>
								<div class="carousel-cell">
									<div id="hubblepic3" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">
										<img class="img-fluid w-100 h-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/bottle-mask.png"  alt="Product">
									</div>
								</div>
								<div class="carousel-cell">
									<div id="hubblepic4" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">
										<img class="img-fluid w-100 h-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/men's-hawaiian-shirt-mockup.png"  alt="Product">
									</div>
								</div>
								<div class="carousel-cell">
									<div id="hubblepic5" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">
										<img class="img-fluid w-100 h-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/boy_mock(1).png"  alt="Product">
									</div>
								</div>
							</div>
							
							<div class="carousel carousel-nav" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
								<div class="carousel-cell" onclick="changeImage('hubblepic1')">
									<img src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/summer-outfit-mockup-with-female-model.png" class="w-100"/>
								</div>
								<div class="carousel-cell" onclick="changeImage('hubblepic2')">
									<img src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/Women_dress_tees_mockup.png" class="w-100"/>
								</div>
								<div class="carousel-cell" onclick="changeImage('hubblepic3')">
									<img src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/bottle-mask.png"  class="w-100"/>
								</div>
								<div class="carousel-cell" onclick="changeImage('hubblepic4')">
									<img src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/men's-hawaiian-shirt-mockup.png"   class="w-100"/>
								</div>
								<div class="carousel-cell" onclick="changeImage('hubblepic5')">
									<img src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/boy_mock(1).png"   class="w-100"/>
								</div>
							</div>

							<input type="range" min="1" max="4" value="1" step="0.1" id="zoomer" oninput="deepdive()">
						</div>
					</div>
				</div>
			</section>
    <section class="section" id="main-content">
        <div class="container mt--100">
        <h1>{{ "Others Images" }}</h1>
            <div class="row">
                 
                @if($images)
                    @forelse ($images as $image)
                        
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="strip">
                                <figure>
                                <a href="{{ route('view_image', $image->id) }}"><img src="{{ asset('/uploads') }}/{{ $image->logo }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" class="img-fluid lazy" alt=""></a>
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
        </div>
    </section> 

       
@endsection

 
@section('js')
<!-- JavaScript Libraries --> 
<!-- JavaScript -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<!-- Main Javascript File --> 
<script>
	var hubblepic = 'hubblepic1';
	var zoomer = document.getElementById("zoomer");
	// var hubblepic = document.getElementsByClassName("hubblepic");
	function changeImage(i){
		hubblepic = i;
	}
	function deepdive() {
		zoomlevel = zoomer.valueAsNumber;
		console.log('zoomlevel',zoomlevel)
		// hubblepic.style.webkitTransform = "scale(" + zoomlevel + ")";
		// hubblepic.style.transform = "scale(" + zoomlevel + ")";
		// hubblepic.style.background-size = '50%';
		var range = (11+zoomlevel*2.225)
		$('#'+hubblepic).css('background-size',range+'%');
	}
</script>
<script>
$(document).ready(function(){

});

jQuery(document).on('click', ".addToCart",function(e) {

    var token = jQuery('input[name="_token"]').val();
    var id = jQuery(this).attr('date-image');
    jQuery('.add-cmsg').remove();
    jQuery(this).prop( "disabled", true );

    var form_data = {
            id  : id,  
            '_token'  : token, 
    };

    jQuery.ajax({
        type:    "POST",
        url:     "{{ route('cartnew') }}",         
        data: form_data,
        dataType: 'json',
        success: function(res) {
            if(res.status == true)
            { 
                jQuery('.addToCart').after('<span class="add-cmsg" style="color:green;font-size:12px;">Image added to cart successfully</span>');
            }else{
                jQuery('.addToCart').after('<span class="add-csmg" style="color:red;font-size:12px;">Something went wrong please try again</span>');
            }        
            jQuery('.addToCart').prop( "disabled", false );                       
        }      
    });

});
</script>
@endsection

