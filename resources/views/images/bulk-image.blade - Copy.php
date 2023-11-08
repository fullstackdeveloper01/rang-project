@extends('layouts.app', ['title' => __('Images Management')])

@section('content')
    @include('restorants.partials.header', ['title' => __('Add Images')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
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
                            <form method="post" action="{{ route('images.bulk_store') }}" autocomplete="off"  enctype="multipart/form-data">
                                @csrf 
                                <div class="row"> 
                                    <div class="col-md-6"> 
                                        <div class="form-group{{ $errors->has('Image') ? ' has-danger' : '' }}">
                                            <?php
                                                $image= ['name'=>'logo','label'=>__('Image'),'value'=>"",'style'=>'width: 200px;'];
                                            ?>
                                            <div class="form-group text-center">
                                                <label class="form-control-label" for="input-name">{{ $image['label'] }}</label>
                                                <div class="text-center">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    
                                                        <div>
                                                            <span class="btn btn-outline-secondary btn-file">
                                                            <span class="fileinput-new">{{ __('Select images') }}</span>
                                                            <span class="fileinput-exists">{{ __('Change') }}</span>
                                                            <input type="file" id="bulk-img-upload"  name="images[]" accept="image/x-png,image/gif,image/jpeg" multiple>
                                                            </span>
                                                            <a href="#" class="btn btn-outline-secondary fileinput-exists fileinput-remove" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             
                                            @if ($errors->has('logo'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif
                                        </div> 
                                    </div>
                                     
                                </div> 
                                <hr /> 
                                <div class="pl-lg-4">
                                     
                                <div class="text-center">
                                    <button type="submit" id="file-sbt" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@section('js')
<script> 
     jQuery(document).on('click', ".fileinput-remove",function(e) { 
        $('.fileinput-preview').remove(); 
     });
     
     jQuery(document).on('blur', "#bulk-img-upload",function(e) { 
        e.preventDefault();
        var datathis = this;
        console.log('cjjd');
        readURL(datathis);
    });
    function readURL(input) {
        $('.fileinput-preview').remove();
        console.log(input.files);
        if (input.files && input.files.length > 0) {
            for(var k in input.files) { 
                var reader = new FileReader();
                reader.onload = function(e) {
                    // jQuery('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    // jQuery('#imagePreview').hide();
                    // jQuery('#imagePreview').fadeIn(650);
                    var img = '<div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="">';
                    img += '<img width="50px" height="50px" src="'+e.target.result+'" alt="..."/> </div> ';
                    $('.fileinput').prepend(img);
                
                }
                reader.readAsDataURL(input.files[k]);
            }
        }
    } 
    </script>
@endsection
