@extends('layouts.front', ['class' => ''])



@section('content') 

@php
  

@endphp
 

    <section class="section section-lg d-md-block" style="padding-bottom: 0px;padding:100px 0;text-align: center;background-color: #bb2c28;color: #fff;margin-top: 100px;background-image:url(https://rangs.manageprojects.in/uploads/images/bg.png);background-repeat:no-repeat;background-size:cover;background-position:center;">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="title">

                    <h1 class="display-3 text text-white">{{ $user->name }}</h1> 

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

		</div>

	</section>
    @csrf

    <section class="section" id="main-content">

        <div class="container mt--100" >

            <div class="pl-4 pb-6 text-left"> 
                <h4>{{ "Images" }} ({{ $images->total() }})</h4>
            </div>

            <div class="row">  

                <div class="col-md-8" >

                    <div class="row"  id="data-wrapper">  

                        @include('front.partials.image-list') 

                    </div>
                </div>
                
                <div class="col-md-4">

                    <!-- List of items -->

                    <div class="card card-profile shadow">
                        <div class="px-4 py-4">
                            <div class="mt-5">
                                <h3>{{ __('Cart') }}<span class="font-weight-light"></span></h3>
                            </div>
                            <!-- List of items -->
                            <div id="cartList" class="border-top">
                                <br />
                                <div class="item-list"  v-for="cart in items">
                                    <div  v-for="item in cart.attributes" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
                                        <div class="info-block block-info clearfix" v-cloak>
                                            <div class="square-box pull-left">
                                            <figure>
                                                <img :src="item.image" :data-src="item.image"  class="productImage" width="100" height="105" alt="">
                                            </figure>
                                            </div>
                                            <h6 class="product-item_title">@{{ item.username }}</h6>
                                            <p class="product-item_quantity"> <!--@{{ item.qty }}--> </p>
                                            <ul class="pagination">
                                            
                                                <li class="page-item">
                                                    <button v-on:click="remove(item.id)"  :value="item.id" class="page-link" >
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                            <!--<div class="input-prepend-append">
                                                <button v-on:click="incQuantity(item.quantity, $event)" :value="item.id"  type="button"class="btn btn-prepend" > - </button>
                                                <button v-on:click="decQuantity(item.quantity, $event)" :value="item.id"  type="button"class="btn btn-append"> + </button>
                                            </div>-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End List of items -->
                            <div class="row">
                                <div class="text-center"> 
                                    <a href="{{ route('request') }}" class="btn btn-success mt-4 addToCart">{{ __('Request Now') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />

                    <!--End  List of items --> 
                </div>

            </div>



             <!-- Data Loader -->
            <div class="auto-load text-center" style="display: none;">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                    <path fill="#000"
                        d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                            from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                    </path>
                </svg>
            </div>
 
        </div>

    </section> 

       

@endsection



 

@section('js')
 

<script> 
    var ENDPOINT = "{{ route('manufacturer.profile') }}"; 
    var page = 1;
    var user_name = '{{  $user->name }}';
    console.log(ENDPOINT)

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
            page++;
            infinteLoadMore(page);
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
            .done(function (response) {
                if (response.html == '') {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
  
                $('.auto-load').hide();
                $("#data-wrapper").append(response.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }

jQuery(document).on('click', ".addToCart",function(e) { 


    var token = jQuery('input[name="_token"]').val();

    var image_id = jQuery(this).attr('data-image');

    var $this = jQuery(this);

    jQuery('.add-cmsg').remove();

    jQuery(this).prop( "disabled", true ); 
    console.log('image_id' , image_id);
    var form_data = {

            id  : image_id,  

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
                $this.text('Added');
                $this.prop( "disabled", true );
                // $this.after('<span class="add-cmsg" style="color:green;font-size:12px;">Image added to cart successfully</span>');
                create_box_area(image_id);

            }else{

                $this.after('<span class="add-csmg" style="color:red;font-size:12px;">Something went wrong please try again</span>');
            }                               

        }      

    }); 

});

function create_box_area(id) {

    var images = $('#imgDiv-'+id);
    var image = $('#imgDiv-'+id).find('img').attr('src');  

    var cart_html = '';
    cart_html += '<div class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">';
    cart_html += '<div class="info-block block-info clearfix">';
    cart_html += '<div class="square-box pull-left">';
    cart_html += '<figure><img src="'+image+'" data-src="'+image+'" width="100" height="105" alt="" class="productImage"></figure>';
    cart_html += '</div> <h6 class="product-item_title">'+user_name+'</h6><p class="product-item_quantity"></p>';
    cart_html += '<ul class="pagination"><li class="page-item">';
    cart_html += '<button v-on:click="remove('+id+')" value="'+id+'" class="page-link"><i class="fa fa-trash"></i></button>';
    cart_html += '</li></ul>';
    cart_html += '</div></div>';
    
    $('#cartList .item-list').append(cart_html);
      
}

</script>

@endsection
 