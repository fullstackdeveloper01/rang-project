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
                                <h3 class="mb-0">{{ __('Images') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('image.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('Images information') }}</h6>
                        <div class="pl-lg-4">
                            <form method="post" action="{{ route('image.store') }}" autocomplete="off"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">


                                    </div>
                                    <div class="col-md-6">


                                    </div>
                                </div>


                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="name">{{ __('Images Name') }}</label>
                                            <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Image Name') }} ..." value="" autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('colors') ? ' has-danger' : '' }}">
                                        
                                            <div class="text-right">
                                                <a href="javascript:void(0);" data-target="add_new_color" class="addNewOption" >+Add New</a> 
                                            </div>     
                                            <div class="add_new_color mb-4" data-type="colors" data-target="colors" style="display:none;">
                                                @csrf
                                                <h4>Add New Color</h4>
                                                <input class="new-state" type="text" placeholder="Enter color name" />
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
                                                <input class="new-state" type="text" placeholder="Enter pattern name"  />
                                                <button type="button" class="btn btn-sm btn-success add-btn-patterns">Save</button>
                                            </div>  
                                            <label class="form-control-label" for="pattern">{{ __('Images Pattern/Design') }}</label>
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
                                        <div class="form-group{{ $errors->has('Image') ? ' has-danger' : '' }}">
                                            <?php
                                                $image= ['name'=>'logo','label'=>__('Image'),'value'=>"",'style'=>'width: 200px;'];
                                            ?>
                                            @include('partials.images',$image)
                                            @if ($errors->has('logo'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="description">{{ __('Images Description') }}</label>
                                            <textarea rows="4" cols="50" name="description"></textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                                <hr />
                                
                                <div class="pl-lg-4">
                                     
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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
    </script>

@endsection