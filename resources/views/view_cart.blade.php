@extends('layouts.front', ['class' => ''])
@section('content')
<section class="section section-lg d-md-block" style="padding-bottom: 0px;padding:100px 0;text-align: center;background-color: #bb2c28;color: #fff;margin-top: 100px;background-image:url(https://rangs.manageprojects.in/uploads/images/bg.png);background-repeat:no-repeat;background-size:cover;background-position:center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                    <h1 class="display-3 text text-white">Cart</h1> 
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <section class="section bg-secondary">

      <div class="container">

          <div class="row">

            <!-- Left part -->
            <div class="col-md-12">

              <!-- List of items -->

              <div class="card card-profile shadow">
                    <div class="px-4 py-4">
                        <div class="mt-5">
                            <h3>{{ __('Cart') }}<span class="font-weight-light"></span></h3>
                        </div>
                        <!-- List of items -->
                        <div  id="cartList" class="border-top">
                            <br />
                           <div  v-for="cart in items">
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


    </div> 
  </section>
@endsection
@section('js')
  <script>
   
  </script>
@endsection

