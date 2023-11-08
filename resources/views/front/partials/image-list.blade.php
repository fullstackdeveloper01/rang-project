 
    @if($images)
        @foreach($images as $image) 
            <div class="col-xl-4 col-md-4 col-lg-6 col-md-6 col-sm-6" id="imgDiv-{{ $image->id }}">
                <div class="strip">
                    <figure>
                    <a href="{{ route('view_image', $image->id) }}"><img class="img-rcs img-fluid lazy" src="{{ asset('uploads') }}/{{ $image->logo }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';"  alt=""></a>
                    </figure>
                    <div class="text-center">
                        <button type="button" data-image="{{ $image->id }}" class="btn btn-sm btn-success addToCart">Add To Cart</button> 
                    </div>
                    <br />
                </div>
            </div> 
        @endforeach  
    @endif 