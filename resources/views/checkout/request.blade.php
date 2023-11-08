@extends('layouts.front', ['class' => ''])
@section('content')
<section class="section section-lg d-md-block" style="padding-bottom: 0px;padding:100px 0;text-align: center;background-color: #bb2c28;color: #fff;margin-top: 100px;background-image:url(https://rangs.manageprojects.in/uploads/images/bg.png);background-repeat:no-repeat;background-size:cover;background-position:center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                    <h1 class="display-3 text text-white">Request</h1> 
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
                <h6 class="heading-small text-muted mb-4">{{ __('Request information') }}</h6>
                <div class="pl-lg-4">
                    
                <form method="post" action="{{ route('user_request') }}" autocomplete="off"  enctype="multipart/form-data">
    
                    @csrf  

                    <div class="current-form">

                        <div class="row">

                            <div class="form-group  {{ $errors->has('fabric_type') ? ' has-danger' : '' }} w-100">
                                <label class="form-control-label" for="input-name">Fabric Type: (word clouds)</label><br>
                                <select class="form-control form-control-alternative" name="fabric_type[]" id="fabric_type" multiple> 
                                    <option value="">Please select</option>                                    

                                    <option value="Cotton Single Jersey">Cotton Single Jersey</option>                            

                                    <option value="Suiting">Suiting</option>                            

                                    <option value="Shirting">Shirting</option>                            

                                    <option value="Rayon">Rayon</option>                            

                                    <option value="Jacquard">Jacquard</option>                            

                                    <option value="Bedsheets">Bedsheets</option>                            

                                    <option value="Satin">Satin</option>                            

                                    <option value="Muslin">Muslin</option>                            

                                    <option value="Modal">Modal</option>                            

                                    <option value="100% Polyester">100% Polyester</option>                            

                                    <option value="Silk">Silk</option>                            

                                    <option value="Spandex">Spandex</option>                            

                                </select>

                                @if ($errors->has('fabric_type'))

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('fabric_type') }}</strong>

                                    </span>

                                @endif 
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group {{ $errors->has('width_type') ? ' has-danger' : '' }} w-100">

                            

                                <label class="form-control-label" for="width_type">Width Type</label><br>

                                

                                <select class="form-control form-control-alternative" name="width_type" id="width_type" > 

                                <option selected value="open width">Open Width</option>                                    

                                <option value="tubular">Tubular</option>                                    

                                </select>

                                @if ($errors->has('width_type'))

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('width_type') }}</strong>

                                    </span>

                                @endif

                                    

                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group {{ $errors->has('open_width_inches') ? ' has-danger' : '' }}  w-100">

                                

                                <label class="form-control-label" for="open_width_inches">Open Width in inches</label><br>

                                

                                <select class="form-control form-control-alternative" name="open_width_inches[]" id="open_width_inches" multiple> 

                                    

                                    @php

                                    for ($i=33; $i <= 120; $i++) {

                                        $i++;  

                                        echo '<option value="'.$i.'">'.$i.'</option>'; 

                                    } 

                                    @endphp              

                                </select>

                                @if ($errors->has('open_width_inches'))

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('open_width_inches') }}</strong>

                                    </span>

                                @endif

                                    

                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group {{ $errors->has('tubular_inches') ? ' has-danger' : '' }} w-100">

                            

                                <label class="form-control-label" for="tubular_inches">Tubular in inches</label><br>

                                    

                                <select class="form-control form-control-alternative" name="tubular_inches[]" id="tubular_inches" multiple> 

                                @php

                                    for ($i=2; $i <= 60; $i++) {  

                                        echo '<option value="'.$i.'">'.$i.'</option>'; 

                                    } 

                                @endphp

                                                

                                </select>

                                @if ($errors->has('tubular_inches'))

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('tubular_inches') }}</strong>

                                    </span>

                                @endif

                                    

                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group {{ $errors->has('gsm_count') ? ' has-danger' : '' }} w-100">

                            

                                <label class="form-control-label" for="gsm_count">GSM (Gram Per Sq Meter) Count</label><br>

                                

                                <select class="form-control form-control-alternative" name="gsm_count" id="gsm_count" >  

                                    @php

                                        for ($i=60; $i <= 500; $i) { 

                                            $j = $i + 20;

                                            if($i != 60){  

                                                $jj = $i+1; 

                                            }else{

                                                $jj = $i;

                                            } 

                                            echo '<option value="'.$jj.'-'.$j.'">'.$jj.'-'.$j.'</option>';

                                            $i=$j;

                                        } 

                                    @endphp

                                </select>

                                @if ($errors->has('gsm_count'))

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('gsm_count') }}</strong>

                                    </span>

                                @endif

                                    

                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group {{ $errors->has('measurement') ? ' has-danger' : '' }} w-100">

                                

                                <label class="form-control-label" for="measurement">Measurement</label><br>

                            

                                <select class="form-control form-control-alternative" name="measurement" id="measurement" > 

                                    <option selected value="kgs">Kgs</option>                                  

                                    <option value="meters">Meters</option>                                  

                                </select>

                                @if ($errors->has('measurement'))

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('measurement') }}</strong>

                                    </span>

                                @endif

                                    

                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }} w-100">

                                    <label class="form-control-label" for="quantity">{{ __('Quantity / Design') }}</label><br>

                                    <input type="text" name="quantity" id="quantity" class="form-control form-control-alternative{{ $errors->has('image_size') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter Quantity') }} ..." value="">

                                    @if ($errors->has('quantity'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('quantity') }}</strong>

                                        </span>

                                    @endif

                                </div>

                            

                        </div> 

                        <div class="row">
                            <div class="text-left">
                                <button type="button" class="btn btn-success mt-4" id="sentRequest">{{ __('Next') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="next-preview" style="display:none;">



                        <div class="col-md-12">

                            <div class="form-group">

                                <label class="form-control-label">{{ __('Fabric Type:') }}</label>

                                <h6 class="input_fabric_type"></h6>

                            </div>

                            </br>

                            <div class="form-group">

                                <label class="form-control-label">{{ __('Width Type') }}</label>

                                <h6 class="input_width_type"></h6>

                            </div>

                            </br>

                            <div class="form-group">

                                <label class="form-control-label">{{ __('Open Width in inches') }}</label>

                                <h6 class="input_open_width_inches"></h6>

                            </div>



                            <div class="form-group">

                                <label class="form-control-label">{{ __('Tubular in inches') }}</label>

                                <h6 class="input_tubular_inches"></h6>

                            </div>



                            <div class="form-group">

                                <label class="form-control-label">{{ __('GSM Count') }}</label>

                                <h6 class="input_gsm_count"></h6>

                            </div>

                            <div class="form-group">

                                <label class="form-control-label">{{ __('Measurement') }}</label>

                                <h6 class="input_measurement"></h6>

                            </div>

                            <div class="form-group">

                                <label class="form-control-label">{{ __('Quantity / Design') }}</label>

                                <h6 class="input_quantity"></h6>

                            </div>



                            </br>

                            

                        </div> 

                        <div class="row">

                            <div class="col-md-6"> 

                                    

                                <div class="text-center">

                                    <button type="submit" class="btn btn-success mt-4" id="sentNowRequest">{{ __('Request Now') }}</button>

                                </div>

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

@section('js')
    <script>  

        $(document).ready(function() {
 
            setTimeout(() => {
                $('#tubular_inches').parent().parent().hide();
                $('#open_width_inches').parent().parent().show();
            }, 500);
        
            $('#measurement').select2({
                placeholder: 'Please select'
            });
            $('#gsm_count').select2({
                placeholder: 'Please select'
            });

            $('#width_type').select2({
                placeholder: 'Please select'
            });
        
            $('#fabric_type').select2({
                placeholder: 'Please select',
                multiple:false, 
            });
            $('#open_width_inches').select2({
                placeholder: 'Please select',
                multiple:true,
                maximumSelectionLength : 5
            });
            $('#tubular_inches').select2({
                placeholder: 'Please select',
                multiple:true,
                maximumSelectionLength : 5
            });
        
            
        });  

        $(document).on('click', '#sentRequest',function() {
            
            var fabric_type = $("#fabric_type :selected").map((_, e) => e.text).get();
            var width_type = $("#width_type :selected").map((_, e) => e.value).get();
            var open_width_inches = $("#open_width_inches :selected").map((_, e) => e.value).get();
            var tubular_inches = $("#tubular_inches :selected").map((_, e) => e.value).get();
            var gsm_count = $("#gsm_count :selected").map((_, e) => e.value).get();
            var measurement = $("#measurement :selected").map((_, e) => e.value).get();
            var quantity = $("#quantity").val();
            $('.add-csmg').remove();
            var formError = 0;

            console.log(fabric_type, width_type, open_width_inches, tubular_inches, gsm_count, measurement, quantity);
            if(fabric_type == '' || fabric_type == null || typeof fabric_type === "undefined" || fabric_type.length === 0)
            { 
                formError = 1;
                $("#fabric_type").parent().after('<span class="add-csmg" style="color:red;font-size:12px;">Please select fabric type</span>');
            } 

            if(width_type == '' || width_type == null || typeof width_type === "undefined")
            {   
                formError = 1;
                $("#width_type").parent().after('<span class="add-csmg" style="color:red;font-size:12px;">Please select Width type</span>');
            }else{
                
                if(width_type == 'tubular')
                {
                    if(tubular_inches === '' || tubular_inches === null || typeof tubular_inches === "undefined" || tubular_inches.length == 0)
                    {
                        formError = 1;
                        $("#tubular_inches").parent().after('<span class="add-csmg" style="color:red;font-size:12px;">Please select tubular</span>');
                    } 

                }else{
                    if(open_width_inches === '' || open_width_inches === null || typeof open_width_inches === "undefined" || open_width_inches.length == 0)
                    {
                        formError = 1;
                        $("#open_width_inches").parent().after('<span class="add-csmg" style="color:red;font-size:12px;">Please select open width</span>');
                    } 
                }
            } 

            if(gsm_count === '' || gsm_count === null || typeof gsm_count === "undefined")
            {
                formError = 1;
                $("#gsm_count").parent().after('<span class="add-csmg" style="color:red;font-size:12px;">Please select GSM count</span>');
            } 

            if(measurement === '' || measurement === null || typeof measurement === "undefined")
            {
                formError = 1;
                $("#measurement").parent().after('<span class="add-csmg" style="color:red;font-size:12px;">Please select measurement</span>');
            } 

            if(quantity === '' || quantity ===  null || typeof quantity === "undefined")
            {
                formError = 1;
                $("#quantity").parent().after('<span class="add-csmg" style="color:red;font-size:12px;">Please enter quantity</span>');
            } 
            if(formError == 0)
            {
                $('.current-form').hide();
                $('.next-preview').show();  
                $('.input_fabric_type').text(fabric_type);
                $('.input_width_type').text(width_type);
                if(width_type == 'tubular')
                { 
                    $('.input_tubular_inches').text(tubular_inches);
                    $('.input_tubular_inches').parent().show();
                    $('.input_open_width_inches').parent().hide();
                }else{
                    $('.input_tubular_inches').parent().hide();
                    $('.input_open_width_inches').parent().show();
                    $('.input_open_width_inches').text(open_width_inches);
                }
                $('.input_gsm_count').text(gsm_count); 
                $('.input_measurement').text(measurement);
                $('.input_quantity').text(quantity);
            }

        });

        $(document).on('blur', '#quantity',function() { 
            var measurement = $('#measurement').val();
            var quantity = $(this).val();
            $('.add-csmg').remove();
            if(measurement == 'kgs')
            {
                if(quantity < 200)
                {
                    jQuery('#sentRequest').prop( "disabled", true ); 
                    jQuery(this).after('<span class="add-csmg" style="color:red;font-size:12px;">Please enter minimum 200kgs/design  </span>');
                    
                }else{
                    jQuery('#sentRequest').prop( "disabled", false ); 
                }

            }else{

                if(quantity < 1200)
                {
                    jQuery('#sentRequest').prop( "disabled", true ); 
                    jQuery(this).after('<span class="add-csmg" style="color:red;font-size:12px;">Please enter minimum 1200ms/design</span>');
                    
                }else{
                    jQuery('#sentRequest').prop( "disabled", false ); 
                } 
            }
            
        });
        $(document).on('change', '#width_type',function() { 
            var width_type = $(this).val();
            console.log(width_type);
            if(width_type == 'tubular')
            {
                $('#tubular_inches').parent().parent().show();
                $('#open_width_inches').parent().parent().hide();
            }else{
                $('#tubular_inches').parent().parent().hide();
                $('#open_width_inches').parent().parent().show();
            }
        });
        
    </script>

@endsection

