@extends('layouts.app', ['title' => __('Images Management')])

@section('content')
    @include('restorants.partials.header', ['title' => __('CSV Upload')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Bulk Images Upload') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('image.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('Images information') }}</h6>
                        <div class="pl-lg-4">
                           
                                @csrf 
                                <div class="row"> 
                                    <div class="col-md-6"> 
                                        <div class="form-group{{ $errors->has('Image') ? ' has-danger' : '' }}">
                                                <?php
                                                    $image= ['name'=>'logo','label'=>__('CSV File'),'value'=>"",'style'=>'width: 200px;'];
                                                ?>
                                                <div class="form-group text-center">
                                                    <input type="file" id="bulk-img-upload" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
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
            <div class=" col-12 mb-4" id="info-alert-logs"> 

               

            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection 


@section('js')
<script> 
  
        
    jQuery(document).on('click', "#csvUploadFile",function(e) {

        e.preventDefault(); 

        var fd = new FormData();
        var file = jQuery('#bulk-img-upload');
        var token = jQuery('input[name="_token"]').val(); 
        var individual_file = file[0].files[0];
        if(file[0].files.length <= 0)
        {
            alert('Please select Images'); return false;
        }
       
        fd.append('csv_file', individual_file); 
        fd.append('_token', token); 
                 
        jQuery.ajax({
            type:    "POST",
            url:     "{{ route('image.csvupload') }}",        
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false, 
            success: function(results) { 
                console.log(results);
                var loghtml = '';
                    loghtml += '<div class="alert alert-success alert-dismissible fade show" role="alert">Total Images :'+results.rows;
                    loghtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    loghtml += '<span aria-hidden="true">&times;</span>';
                    loghtml += '</button></div> '; 
                    jQuery('#info-alert-logs').prepend(loghtml);

                upload_buik_image_ajax(results);
            }      
        });
    });

    function upload_buik_image_ajax(data) {

        var token = jQuery('input[name="_token"]').val();

        var file = jQuery('#bulk-img-upload');
        var individual_file = file[0].files[0];
        var image_count = parseInt(data.image_count);
        
        var fd = new FormData();
        fd.append('csv_file', individual_file); 
        fd.append('image_count', image_count); 
        fd.append('_token', token);  
         
        jQuery.ajax({
            type:    "POST",
            url:     "{{ route('image.ajaxstore') }}",        
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false, 
            success: function(results) { 
                console.log(results);
                if(parseInt(results.image_count) >= parseInt(results.rows))
                {
                    alert('Successfull');
                }else{
                    var loghtml = '';
                    loghtml += '<div class="alert alert-success alert-dismissible fade show" role="alert">Imported images '+image_count+' to '+results.image_count;
                    loghtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    loghtml += '<span aria-hidden="true">&times;</span>';
                    loghtml += '</button></div> '; 
                    jQuery('#info-alert-logs').prepend(loghtml);
                    upload_buik_image_ajax(results);
                } 
            }      
        });
    } 

    
    </script>
@endsection 