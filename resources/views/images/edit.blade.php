@extends('layouts.app', ['title' => __('Orders')])

@section('content')
<style>
    .repeatable-field-demo-form .button {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        font-family: inherit;
        font-weight: 600;
        color: #fff;
        background: #2563eb;
        cursor: pointer;
    }

    .button:focus {
        box-shadow: rgba(59, 130, 246, 0.5) 0px 0px 0px 3px;
        outline: none;
    }

    .repeatable-field-demo-form {
        /* display: flex;
        flex-direction: column; */
        max-width: 768px;
        margin: 0 auto;
    }

    .repeatable-field-demo-form h1 {
        text-align: center;
    }

    .repeatable-field-demo-form > * + * {
            /* margin-top: 2.5rem; */
    }

    .repeatable-field {
        padding: 0;
        border: none;
    }

    .repeatable-field > legend {
        width: 100%;
        font-size: 24px;
        text-align: center;
        color: #111;
    }

    .repeatable-field__rows {
        margin: 0;
        margin-top: 1rem;
        padding: 0;
        list-style-type: none;
    }

    .repeatable-field__rows > .repeatable-field__row + .repeatable-field__row {
        margin-top: 0.815rem;
    }

    .repeatable-field__row:only-child .repeatable-field__remove-button {
        display: none;
    }

    .repeatable-field__row-wrap {
        display: flex;
    }

    .repeatable-field__input {
        flex: 1;
    }

    .repeatable-field__remove-button {
        margin-left: 0.5rem;
        padding: 0.25rem;
        color: #b91c1c;
        background: none;
    }

    .repeatable-field__remove-button:hover,
    .repeatable-field__remove-button:focus {
        text-decoration: underline;
        box-shadow: none;
    }

    .repeatable-field__bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .repeatable-field__limit-counter {
        font-size: 18px;
        color: #555;
    }

    .repeatable-field__add-button {
        display: block;
        font-size: 14px;
    }
</style>
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <br/>
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Images Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                            <a href="{{ route('image.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       <h6 class="heading-small text-muted mb-4">{{ __('Images information') }}</h6>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                            <div class="pl-lg-4">
                            <form method="post" action="{{ route('image.update', $image) }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    @method('put') 

                                    <input type="hidden" id="rid" value="{{ $image->id }}"/>

                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="name">{{ __('Images Name') }}</label>
                                        <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Image Name') }} ..." value="{{ old('name', $image->name) }}" autofocus>
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
                                                <input class="new-state" type="text"  placeholder="Enter color name"  />
                                                <button type="button" class="btn btn-sm btn-success add-btn-color">Save</button>
                                            </div>   
                                            <label class="form-control-label" for="colors">{{ __('Colors') }}</label>
                                             <select name="colors[]" class="form-control" id="colors" multiple>
                                                    <option value="">Please select colors</option>
                                                    @if($ccolors)
                                                        @foreach($ccolors as $color)
                                                            @if(in_array($color->id, $colors))
                                                                <option selected value="{{ $color->id }}">{{ $color->name }}</option>
                                                            @else
                                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                            @endif
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
                                                    @if($ddesignPatterns)
                                                        @foreach($ddesignPatterns as $color)
                                                            @if(in_array($color->id, $designPatterns))
                                                                <option selected value="{{ $color->id }}">{{ $color->name }}</option>
                                                            @else
                                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                            @endif
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
                                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="description">{{ __('Images Description') }}</label>
                                                <textarea rows="4" cols="50" name="description">{{ old('description', $image->description) }}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="form-group{{ $errors->has('Image') ? ' has-danger' : '' }}">
                                                <?php
                                                    $image_path = asset('uploads').'/'.$image->logo;
                                                    $image= ['name'=>'logo','label'=>__('Image'),'value'=>$image_path,'style'=>'width: 200px;'];
                                                ?>
                                                @include('partials.images',$image)
                                                @if ($errors->has('logo'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('logo') }}</strong>
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                    </div> 
                                  
                                
                                </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div> 
                            
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
    
@endsection
 
@section('js')
<script type="text/javascript"> 
  
 
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
