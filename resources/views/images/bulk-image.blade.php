@extends('layouts.app', ['title' => __('Images Management')])

@section('content')
    @include('restorants.partials.header', ['title' => __('Upload Upload')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Bulk Upload Images') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('image.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"> 
                        
                        <div class="pl-lg-4"> 
                                @csrf  
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('colors') ? ' has-danger' : '' }}">
                                            <div class="text-right">
                                                <a href="javascript:void(0);" data-target="add_new_color" class="addNewOption" >+Add New</a> 
                                            </div>     
                                            <div class="add_new_color mb-4" data-type="colors" data-target="colors" style="display:none;">
                                                @csrf
                                                <h4>Add New Color</h4>
                                                <input class="new-state" type="text"  placeholder="Enter color name"  />
                                                <button type="button" class="btn btn-sm btn-success add-btn-color">Save</button>
                                            </div>  
                                            <label class="form-control-label" for="colors">{{ __('Colors') }}</label>
                                             <select name="colors[]" class="form-control" id="colors" multiple>
                                                    <option value="">Please select colors</option>
                                                    @if($colors)
                                                        @foreach($colors as $color)
                                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                        @endforeach
                                                    @endif
                                             </select>
                                            @if ($errors->has('colors'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('colors') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group{{ $errors->has('pattern') ? ' has-danger' : '' }}">
                                        <div class="text-right">
                                                <a href="javascript:void(0);" data-target="add_new_patterns" class="addNewOption" >+Add New</a> 
                                            </div>     
                                            <div class="add_new_patterns mb-4" data-type="patterns" data-target="patterns" style="display:none;">
                                                @csrf
                                                <h4>Add New Pattern/Design</h4>
                                                <input class="new-state" type="text"  placeholder="Enter pattern name"  />
                                                <button type="button" class="btn btn-sm btn-success add-btn-patterns">Save</button>
                                            </div>  
                                            <label class="form-control-label" for="pattern">{{ __('Images Pattern') }}</label>
                                            <select name="patterns[]" class="form-control" id="patterns" multiple>
                                                    <option value="">Please select patterns</option>
                                                    @if($designPatterns)
                                                        @foreach($designPatterns as $color)
                                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                        @endforeach
                                                    @endif
                                             </select>
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
                                            <h4 class="heading-small text-muted mb-4">{{ __('Select Multiple Images') }}</h4>
                                        </div>
                                        <div class="text-center form-group{{ $errors->has('Image') ? ' has-danger' : '' }}">
                                            <?php
                                                $image= ['name'=>'logo','label'=>__('CSV File'),'value'=>"",'style'=>'width: 200px;'];
                                            ?>
                                            <div class="form-group text-center">
                                                <input type="file" id="bulk-img-upload" name="file" multiple>
                                            </div>
                                            
                                        </div> 
                                    </div> 
                                </div> 
                                <hr /> 
                                <div class="pl-lg-4">
                                     
                                <div class="text-center">
                                    <button type="button" id="csvUploadFile" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <div class="row col-xl-12" >
            <div class="col-10 mb-4" id="info-alert-logs"> 

         
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection 
 

@section('js')
<script> 
    $(document).ready(function() { 
            $('#colors').select2({
                placeholder: 'Please select colors',
                multiple:true,
                maximumSelectionLength : 3
            });

            $('#patterns').select2({
                placeholder: 'Please select patterns',
                multiple:true,
                maximumSelectionLength : 3
            });

            
        }); 

    jQuery(document).on('click', "#csvUploadFile",function(e) {

        e.preventDefault(); 

        var file = jQuery('#bulk-img-upload');

        var colors = $('#colors').val().length; 

        var patterns = $('#patterns').val().length; 

        if(colors == 0)
        {
            alert(' Please Select Colors');
            return;
        }
        if(patterns == 0)
        {
            alert(' Please Select patterns');
            return;
        }

        var files = file[0].files; 

        if(files.length > 0)
        {
            var loghtml = '';
            loghtml += '<div class="alert alert-success alert-dismissible fade show" role="alert">Total Images :'+files.length;
            loghtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            loghtml += '<span aria-hidden="true">&times;</span>';
            loghtml += '</button></div> '; 
            jQuery('#info-alert-logs').prepend(loghtml);
            jQuery('.card-body').css('pointer-events', 'none');
            jQuery('.card-body').css('opacity', '0.5');
            upload_buik_image_ajax2(0);
        }else{
            alert('Please select Images');
        } 
        return; 
    });

    function upload_buik_image_ajax2(image_count) {

        var token = jQuery('input[name="_token"]').val();

        var file = jQuery('#bulk-img-upload');

        var colors = $('#colors').val(); 
        var patterns = $('#patterns').val(); 
 
        var image_count = parseInt(image_count); 
        var files = file[0].files; 
       
        var imgFiles = '';
        var image_count2 = image_count + 1;
        var imageCount = 0;

        for (var i = image_count; i < image_count2; i++) { 
            imgFiles = files[i];   
            imageCount = i;   
        }

        console.log(imgFiles, files);

        var fd = new FormData();
        fd.append('totalfiles', files.length); 
        fd.append('image_count', image_count); 
        fd.append('csv_file', imgFiles); 
        fd.append('patterns', patterns); 
        fd.append('colors', colors); 
        fd.append('_token', token);  

        jQuery.ajax({
            type:    "POST",
            url:     "{{ route('images.bulk_store') }}",        
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false, 
            success: function(results) { 
                console.log(results);
                var loghtml = '';
                loghtml += '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                loghtml += '<img width="50px" height="50px" src="'+results.fileurl+'" alt="..."/> Imported images '+image_count2;
                loghtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                loghtml += '<span aria-hidden="true">&times;</span>';
                loghtml += '</button></div> '; 
                jQuery('#info-alert-logs').prepend(loghtml); 
                
                if(image_count2 >=files.length)
                {
                    jQuery('.card-body').attr('style', '');
                    alert('Successfull import');
                }else{
                    
                    upload_buik_image_ajax2(i);
                } 
            }      
        });
    }  

    
    </script>
@endsection 