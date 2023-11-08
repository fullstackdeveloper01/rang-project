@extends('layouts.front', ['class' => ''])



@section('content') 

@php



$openingTime ='';

@endphp

    <!-- CSS -->

    <style>

	    .carousel{

			margin-top:40px;

		}

		/* Make the image fully responsive */

		.carousel-inner img {

			width: 100%;

			height: 400px;

		}

		.carousel-indicators{

			display:inline-block;

			max-height: 400px;

			overflow-y: auto;

			overflow-x: hidden;

			position:static;

			direction: rtl;

		}

		.carousel-inner{

			margin-left:20px!important;

			box-shadow:2px 2px 19px -7px rgba(0,0,0,0.1);;

		}

		@media screen and (max-width:992px){

			.carousel-indicators{

				display: inline-flex;

				direction: inherit;

				height: auto;

				width: 100%;

				max-width:800px;

				overflow-x: auto;

				position: relative;

				margin-left: 0;

				margin-right: 0;

				overflow-y: hidden;

				justify-content: normal;

				margin-bottom:20px;

			}

			.carousel-inner{

				margin-left:0!important;

			}

			.carousel-inner img{

				width:100%;

			}

		}

		/* width */

		::-webkit-scrollbar {

			width: 5px;

			height: 5px;

		}



		/* Track */

		::-webkit-scrollbar-track {

			background: #f1f1f1; 

		}



		/* Handle */

		::-webkit-scrollbar-thumb {

			background: #888; 

		}



		/* Handle on hover */

		::-webkit-scrollbar-thumb:hover {

			background: #555; 

		}

		.item{

			margin-bottom:10px;

			margin-left: 10px;

			cursor:pointer;

		}

		.item.active img{

			border:1px solid red;

			opacity:1;

		}

		.item img{

			border:1px solid transparent;

			opacity:0.5;

			transition:0.5s;

		}

		.item:hover img{

			border:1px solid red;

			opacity:1;

		}

		.content {

			position: absolute;

			bottom: 0;

			background: rgba(0, 0, 0, 0.5); /* Black background with transparency */

			color: #f1f1f1;

			width: 100%;

			padding: 10px;

		}

		.content p{

			font-size:15px;

		}

		@media screen and (max-width: 992px) {

			.content{

				position:static;

			}

		}

		@media screen and (min-width: 880px) and (max-width: 1199px) {

			.content{

				position: static;

			}

		}

		@media screen and (min-width: 576px) and (max-width: 879px) {

			.content{

				position: static;

			}

		}

		.vert .carousel-item-next.carousel-item-left,

		.vert .carousel-item-prev.carousel-item-right {

			-webkit-transform: translate3d(0, 0, 0);

			transform: translate3d(0, 0, 0);

		}

		.vert .carousel-item-next,

		.vert .active.carousel-item-right {

			-webkit-transform: translate3d(0, 100%, 0);

			transform: translate3d(0, 100% 0);

		}

		.vert .carousel-item-prev,

		.vert .active.carousel-item-left {

			-webkit-transform: translate3d(0,-100%, 0);

			transform: translate3d(0,-100%, 0);

		}

		@media all and (max-width: 500px) {

			#zoomer {

				width: 85%;

			}

		}

		#zoomer {

			display: block;

			width: 100%;

			margin: 1rem auto;

		}

		.carousel-item{

			height:400px;

		}

		.carousel-item div{

			height: 400px;

			width: 400px;

			margin: 0 auto;

		}

		.carousel-item div img{

			height:100%!important;

		}

		.product-description h1.heading-title {

			font-size: 40px;

			line-height: normal;

			color:#333333 !important;

			margin-bottom: 10px;

		}

		.product-description {

			margin: 15px 0;

			font-size: 15px;

			color:#333333 !important;

			margin-bottom: 10px;

		}

		.product-description p.price {

			margin: 10px 0px;

			color:#333333 !important;

			margin-bottom: 10px;

		}

		.product-description .price span.amount {

			font-size: 24px;

			font-weight: 600;

			color:#333333 !important;

			margin-bottom: 10px;

		}

		.product-description p.stock {

			margin: 0 0 25px 0;

			display: block;

			padding: 12px 8px;

			border-top: 1px solid #f1f1f1;

			border-bottom: 1px solid #f1f1f1;

		}

		.tags a {

			display: inline-block;

			padding: 1px 4px;

			background-color: #f5f5f5;

			border: 1px solid #f1f1f1;

			text-decoration: none;

			margin: 3px;

			font-size: 11px;

			color: #999999;

		}

		.w-70{width:70%;}

		.nav-tabs {

			margin-bottom: 0px !important;

			padding: 0px;

			border-top: 1px solid #f1f1f1;

			border-bottom:0;

		}

		.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{

			border-top:4px solid #000!important;

			border-radius:0px;

			border:0px;

			color:#000!important;

		}

		.nav-tabs .nav-link{

			border-top:4px solid transparent!important;

		}

		.nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover{

			border:0px;

		}

		.nav-tabs .nav-link.active a{

			padding: 10px 15px !important;

			font-size: 14px;

			font-weight: 600;

			text-align: center;

			text-decoration: none;

			margin-top: -2px;

			display: inline-block;

			color: #000 !important;

			border-top: 4px solid transparent;

			letter-spacing: 1px;

			position: relative;

		}

		.nav-tabs a{

			padding: 10px 15px !important;

			font-size: 14px;

			font-weight: 600;

			text-align: center;

			text-decoration: none;

			margin-top: -2px;

			display: inline-block;

			color: #919191 !important;

			border-top: 4px solid transparent;

			letter-spacing: 1px;

			position: relative;

		}

		.text-black{color:#000;}

		.fz-16{font-size:16px;}

		.fz-14{font-size:14px;}

	</style>  



    <!--<section class="section-profile-cover section-shaped grayscale-05 d-none d-md-none d-lg-block d-lx-block">-->

      <!-- Circles background -->

    <!--  <img class="bg-image" src="{{ asset('uploads') }}/{{ $restorant->logo }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" style="width: 100%;">-->

      <!-- SVG separator -->

    <!--  <div class="separator separator-bottom separator-skew">-->

    <!--    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">-->

    <!--      <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>-->

    <!--    </svg>-->

    <!--  </div>-->

    <!--</section>-->

    <!--<section class="section section-lg pt-lg-0 mt--9 d-none d-md-none d-lg-block d-lx-block">-->

    <!--    <div class="container">-->

    <!--        <div class="row">-->

    <!--            <div class="col-lg-12">-->

    <!--                <div class="title white"  <?php if($restorant->description || $openingTime && $closingTime){echo 'style="border-bottom: 1px solid #f2f2f2;"';} ?> >-->

    <!--                    <h1 class="display-3 text-white">{{ $restorant->username }}</h1> -->

                       

    <!--                </div>-->

    <!--            </div>-->

    <!--        </div>-->

    <!--    </div>-->

    <!--</section> -->

    <section class="section section-lg d-md-block" style="padding-bottom: 0px;padding:100px 0;text-align: center;background-color: #bb2c28;color: #fff;margin-top: 100px;background-image:url(https://rangs.manageprojects.in/uploads/images/bg.png);background-repeat:no-repeat;background-size:cover;background-position:center;">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="title">

                    <h1 class="display-3 text text-white">{{ $restorant->username }}</h1> 

                    </div>

                </div>

            </div>

        </div>

    </section> 

    <section style="padding:50px 0;">

		<div class="container">

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

				<div class="col-md-12 col-xl-6 col-lg-6">

					<div id="demo" class="carousel slide vert" data-ride="carousel" data-interval="false">

						<div class="row no-gutters">

							<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">

								<div class="carousel-indicators m-0">

									<div data-target="#demo" data-slide-to="0" class="item active" onclick="changeImage('hubblepic1')">

										<img style="background-size: 22.5%;background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;);" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/summer-outfit-mockup-with-female-model.png" class="w-100 img-fluid"/>

									</div>

									<div data-target="#demo" data-slide-to="1" class="item" onclick="changeImage('hubblepic2')">

										<img style="background-size: 22.5%;background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;);" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/Women_dress_tees_mockup.png" class="w-100 img-fluid"/>

									</div>

									<div data-target="#demo" data-slide-to="2" class="item" onclick="changeImage('hubblepic3')">

										<img style="background-size: 22.5%;background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;);" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/bottle-mask.png"  class="w-100 img-fluid"/>

									</div>

									<div data-target="#demo" data-slide-to="3" class="item" onclick="changeImage('hubblepic4')">

										<img style="background-size: 22.5%;background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;);" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/men's-hawaiian-shirt-mockup.png" class="w-100 img-fluid"/>

									</div>

									<div data-target="#demo" data-slide-to="4" class="item" onclick="changeImage('hubblepic5')">

										<img style="background-size: 22.5%;background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;);" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/boy_mock(1).png"   class="w-100 img-fluid"/>

									</div>

									<div data-target="#demo" data-slide-to="5" class="item" onclick="changeImage('hubblepic6')">

										<img  src="{{ asset('uploads') }}/{{ $restorant->logo }}"   class="w-100 img-fluid"/>

									</div>

								</div>

							</div><!-- col-sm-3 Indicators -->

							

							<div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">

								<div class="carousel-inner">

									<div class="carousel-item active">

										<div id="hubblepic1" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">

											<img  class="img-fluid w-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/summer-outfit-mockup-with-female-model.png" alt="Product">

										</div>

									</div>

									<div class="carousel-item">

										<div id="hubblepic2" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">

											<img  class="img-fluid w-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/Women_dress_tees_mockup.png"  alt="Product">

										</div>

									</div>

									<div class="carousel-item">

										<div id="hubblepic3" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">

											<img class="img-fluid w-100 h-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/bottle-mask.png"  alt="Product">

										</div>

									</div>

									<div class="carousel-item">

										<div id="hubblepic4" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">

											<img class="img-fluid w-100 h-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/men's-hawaiian-shirt-mockup.png"  alt="Product">

										</div>

									</div>

									<div class="carousel-item">

										<div id="hubblepic5" style="background-size: 11%; background-image: url(&quot;{{ asset('uploads') }}/{{ $restorant->logo }}&quot;); background-position: 76.0833px -463.5px;">

											<img class="img-fluid w-100 h-100" src="https://surfacepatternmarketplace.com/wp-content/themes/rigid-child/image/boy_mock(1).png"  alt="Product">

										</div>

									</div>
									<div class="carousel-item">

										<div id="hubblepic6" style="background-size: 11%;  background-position: 76.0833px -463.5px;">

											<img class="img-fluid w-100 h-100" src="{{ asset('uploads') }}/{{ $restorant->logo }}"  alt="Product">

										</div>

									</div>

								</div><!--inner-->

							</div><!-- col-sm-9  -->

						</div><!--row-->

					</div>

					<div class="d-flex align-items-center w-70 m-auto">

						<span class="fa fa-minus mr-2" aria-hidden="true"></span>

						<input type="range" min="1" max="4" value="1" step="0.1" id="zoomer" oninput="deepdive()">

						<span class="fa fa-plus ml-2" aria-hidden="true"></span>

					</div>

				</div>

				<div class="col-md-12 col-xl-6 col-lg-6">

					<div class="product-description mt-5 ml-2">

						<h1 class="product_title entry-title heading-title">Daisy</h1>

						<p class="mb-0">White daisy flower with blue background.</p>

						<p class="price">

							<span class="woocommerce-Price-amount amount">

								<bdi><span class="woocommerce-Price-currencySymbol">$</span>39.00</bdi>

							</span>

						</p>

						<p class="stock in-stock">10 in stock</p>

						 
						<form class="cart mb-4">
							&nbsp;&nbsp;
							<a href="javascript:void(0);" class="text-black">

								<i class="fa fa-heart" aria-hidden="true"></i>

							</a>

							&nbsp;&nbsp;&nbsp;&nbsp;

							@csrf 

							<button type="button" date-image="{{ $restorant->id }}" name="add-to-cart" class="btn btn-primary addToCart">Add to cart</button>

							

						</form>

						<div class="tags">

							<span class="posted_in">Categories:</span>

							<a href="https://surfacepatternmarketplace.com/product-category/abstract-and-geometric/" rel="tag">Abstract &amp; Geometric</a>, <a href="https://surfacepatternmarketplace.com/product-category/active-wear/" rel="tag">Active Wear</a>, 

							<a href="https://surfacepatternmarketplace.com/product-category/festival/" rel="tag">Festival</a>, 

							<a href="https://surfacepatternmarketplace.com/product-category/floral/" rel="tag">Floral</a>, 

							<a href="https://surfacepatternmarketplace.com/product-category/home-interiors/" rel="tag">Home Interiors</a>, 

							<a href="https://surfacepatternmarketplace.com/product-category/kids-wear/" rel="tag">Kids Wear</a>, 

							<a href="https://surfacepatternmarketplace.com/product-category/spring-summer-2022/" rel="tag">Spring Summer 2022</a>, 

							<a href="https://surfacepatternmarketplace.com/product-category/swimwear/" rel="tag">Swimwear</a>,

							<a href="https://surfacepatternmarketplace.com/product-category/womens-wear/" rel="tag">Women's Wear</a>

							<span class="tagged_as">Tags:</span><a href="https://surfacepatternmarketplace.com/product-tag/geometric/" rel="tag">#geometric</a>, <a href="https://surfacepatternmarketplace.com/product-tag/home-interiors/" rel="tag">#home interiors</a>, <a href="https://surfacepatternmarketplace.com/product-tag/summer/" rel="tag">#summer</a></div>

					</div>

				</div>

			</div>

			<div class="row mt-5">

				<div class="col-md-12 col-xl-12 col-lg-12">	

					<ul class="nav nav-tabs justify-content-center" role="tablist">

						<li class="nav-item">

							<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>

						</li>

						<li class="nav-item">

							<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">More Offers</a>

						</li>

						<li class="nav-item">

							<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Store Policies</a>

						</li>

					</ul><!-- Tab panes -->

					<div class="tab-content">

						<div class="tab-pane active" id="tabs-1" role="tabpanel">

							<div class="entry-content">

                                <p>White daisy flower with blue background.</p>

                                <div class="jp-relatedposts" style="display: block;">

                                    <h5 class="headline text-underline"><em>Related</em></h5>

                                    <div class="posts-items d-flex align-items-center justify-content-space-between">

                                        <p class="posts-post">

                                            <span class="posts-post-title">

                                                <a class="posts-post-a text-black fz-16" href="#">Daisy</a>

                                            </span>

                                            <time class="jp-relatedposts-post-date fz-14" style="display:block;">April 9, 2023</time>

                                            <span class="jp-relatedposts-post-context fz-14">Similar post</span>

                                        </p>

                                        <p class="posts-post">

                                            <span class="posts-post-title">

                                                <a class="posts-post-a text-black fz-16" href="#">Abstract Daisy</a>

                                            </span>

                                            <time class="jp-relatedposts-post-date fz-14" style="display:block;">November 6, 2020</time>

                                            <span class="jp-relatedposts-post-context fz-14">Similar post</span>

                                        </p>

                                        <p class="posts-post">

                                            <span class="posts-post-title">

                                                <a class="dposts-post-a text-black fz-16" href="#">RETRO JOY DAISY 90S HIPPIE JOYFUL RAINBOW FLORAL SEAMLESS PATTERN PRINT VECTOR</a>

                                            </span>

                                            <time class="jp-relatedposts-post-dat fz-14e" style="display:block;">August 28, 2022</time>

                                            <span class="jp-relatedposts-post-context fz-14">Similar post</span>

                                        </p>

                                    </div>

                                </div>

                            </div>

						</div>

						<div class="tab-pane" id="tabs-2" role="tabpanel">

							<div class="entry-content">

                                <p>No more offers for this product!</p>

                            </div>

						</div>

						<div class="tab-pane" id="tabs-3" role="tabpanel">

							<div class="product-policies">

                               <div class="shipping-policies">

                                  <h5 class="policies_heading">Shipping Policy</h5>

                                  <div class="policies_description">

                                     <h6><strong><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: Arial Black, sans-serif" data-mce-style="font-family: Arial Black, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;"><b>Delivery policy -</b></span></span></span></strong></h6>

                                     <p><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">All our product purchases are delivered by downloadable digital files, and are sent as a downloadable link via email confirmation to the registered purchaser, or can be downloaded at any time from your buyer\'s account. We aim to deliver the file within 24 - 48 hrs of purchase this is due to the time difference in different countries where our designers are based.</span></span></span></p>

                                     <p>You will have 7 days on receipt of the digital design to contact us if you have any queries or problems with the design.</p>

                                  </div>

                               </div>

                               <div class="refund-policies">

                                  <h5 class="policies_heading">Refund Policy</h5>

                                  <div class="policies_description">

                                     <h6><strong><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: Arial Black, sans-serif" data-mce-style="font-family: Arial Black, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;"><b>Returns Policy Customers -</b></span></span></span></strong></h6>

                                     <p><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">Under the Distance Selling Regulations, you may cancel a purchase at any time within 14 working days prior to receiving the artwork/design subject to the terms set out below:</span></span></span></p>

                                     <ul>

                                        <li><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">If you cancel a purchase due to the above reasons, you will be refunded in full.</span></span></span></li>

                                        <li><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">If you decide to cancel a purchase after the digital item has been downloaded by yourself a refund cannot be given.</span></span></span></li>

                                        <li><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">A refund can only be given if the item received is faulty.</span></span></span></li>

                                        <li>If you should have a problem with downloading a file please do contact us as soon as possible and we will assist you with your purchase contact: info@rang.com</li>

                                     </ul>

                                  </div>

                               </div>

                               <div class="cancellation-policies">

                                  <h5 class="policies_heading">Cancellation / Return / Exchange Policy</h5>

                                  <div class="policies_description">

                                     <h6><strong><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: Arial Black, sans-serif" data-mce-style="font-family: Arial Black, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;"><b>Cancellations/Returns Policy Customers -</b></span></span></span></strong></h6>

                                     <p><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">Under the Distance Selling Regulations, you may cancel a purchase at any time within 14 working days prior to receiving the artwork/design subject to the terms set out below:</span></span></span></p>

                                     <ul>

                                        <li><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">If you cancel a purchase due to the above reasons, you will be refunded in full.</span></span></span></li>

                                        <li><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">If you decide to cancel a purchase after the digital item has been downloaded by yourself a refund cannot be given.</span></span></span></li>

                                        <li><span style="color: #333333" data-mce-style="color: #333333;"><span style="font-family: proxima-nova, sans-serif" data-mce-style="font-family: proxima-nova, sans-serif;"><span style="font-size: medium" data-mce-style="font-size: medium;">A refund can only be given if the item received is faulty.</span></span></span></li>

                                        <li>If you should have a problem with downloading a file please do contact us as soon as possible and we will assist you with your purchase contact: info@rang.com</li>

                                     </ul>

                                  </div>

                               </div>

                            </div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

    <section class="section section-lg pt-lg-0" id="restaurant-content" style="padding-top: 0px">



        <div class="container container-restorant"> 
           

            <!--<div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">

                    <div class="strip">

                        <figure>

                        <img src="{{ asset('uploads') }}/{{ $restorant->logo }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" class="img-fluid lazy" alt="">

                        </figure> 

                    </div>

                </div>

            </div>--> 

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



