<div class="card card-profile shadow">
    <div class="px-4">
      <div class="mt-5">
        <h3><span class="delTime">{{ __('Delivery time') }}</span><span class="picTime">{{ __('Pickup time') }}</span><span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        <select name="timeslot" id="timeslot" class="form-control{{ $errors->has('timeslot') ? ' is-invalid' : '' }}" required>
          @foreach ($timeSlots as $value => $text)
              <option value={{ $value }}>{{$text}}</option>
          @endforeach
      </select>
      </div>
      <br />
      <br />
    </div>
  </div>
  <br />

  <!-- @foreach($cart as $key=> $cart_data)
    @foreach($cart_data->attributes as $key=> $item_data)

        <div  v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
            <div class="info-block block-info clearfix" v-cloak>
                <div class="square-box pull-left">
                <figure>
                    <img src="{{ asset('uploads') }}/{{ $item_data['image'] }}" onerror="this.onerror=null;this.src='http://127.0.0.1:8088/argon/img/logos/new -02.png';" data-src="{{ asset('uploads') }}/{{ $item_data['image'] }}"  class="productImage" width="100" height="105" alt="">
                </figure>
                </div>
                <h6 class="product-item_title"> {{'Image'}} </h6>
                <p class="product-item_quantity">{{$item_data['qty']}}</p>
                <ul class="pagination">
                    <li class="page-item">
                        <button v-on:click="decQuantity({{$item_data['id']}})" :value="{{$item_data['id']}}" class="page-link" tabindex="-1">
                            <i class="ni ni-fat-delete"></i>
                        </button>
                    </li>
                    <li class="page-item">
                        <button v-on:click="incQuantity({{$item_data['id']}})" :value="{{$item_data['id']}}" class="page-link" >
                            <i class="ni ni-fat-add"></i>
                        </button>
                    </li>
                    <li class="page-item">
                        <button v-on:click="remove({{$item_data['id']}})"  :value="{{$item_data['id']}}" class="page-link" >
                            <i class="fa fa-trash"></i>
                        </button>
                    </li>
                </ul> 
            </div>
        </div>
    @endforeach
@endforeach -->