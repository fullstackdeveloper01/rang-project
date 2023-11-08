@extends('layouts.app', ['title' => __('Design Patterns')])

@section('content')
 
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
                                <h3 class="mb-0">{{ __('Design Patterns Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                            <a href="{{ route('designPatterns.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       <h6 class="heading-small text-muted mb-4">{{ __('Design Patterns information') }}</h6>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                            <div class="pl-lg-4">
                            <form method="post" action="{{ route('designPatterns.update', $color) }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    @method('put') 

                                    <input type="hidden" id="rid" value="{{ $color->id }}"/>

                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="name">{{ __('Name') }}</label>
                                                <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }} ..." value="{{ old('name', $color->name) }}" autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
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
function getRefs(el) {
  let result = {};
  
  [...el.querySelectorAll('[data-ref]')]
    .forEach(ref => {
      result[ref.dataset.ref] = ref;
    });
  
  return result;
}

function getProps(el) {
  return JSON.parse(el.dataset.props);
}

function createFromHTML(html='') {
  let element = document.createElement(null);
  element.innerHTML = html;
  return element.firstElementChild;
}

function fieldRepeaterComponent(el) {
  const props = getProps(el);
  const refs = getRefs(el);
  
  let rowNumber = props.currentRows;
  
  function renderRow() {
    return `
      <li class="repeatable-field__row">
        <div class="repeatable-field__row-wrap">
          <input
              class="repeatable-field__input form-field"
              data-ref="input"
              type="text"
              name="${props.inputName}[]"
              aria-label="${props.labelText} #${rowNumber}"
          />

          <button
              class="repeatable-field__remove-button button"
              data-ref="removeButton"
              type="button"
          >
            ${props.removeLabel ?? 'Remove'}
          </button>
        </div>
      </li>
    `;
  }
  
  function updateLimitCounter() {
    const rowCount = refs.rowList.children.length;
    refs.limitCounter.innerText = `${rowCount}/${props.maxRows}`;
  }
  
  function addRow(focusInput=false) {
    if (refs.rowList.children.length >= props.maxRows)
      return;
    
    let newRow = createFromHTML(renderRow());
    const rowRefs = getRefs(newRow);

    rowRefs.removeButton.onclick = (e) => {
      e.preventDefault();
      removeRow(newRow);
    }
    
    refs.rowList.appendChild(newRow);
    
    if (focusInput) rowRefs.input.focus();
    
    if (refs.rowList.children.length >= props.maxRows) {
      refs.addButton.style.display = 'none';
    }
    
    rowNumber += 1;
    
    updateLimitCounter();
  }
  
  function removeRow(row) {
    if (refs.rowList.children.length <= 1)
      return;
    
    row.remove();
    el.focus();
    
    updateLimitCounter();
    
    if (refs.rowList.children.length < props.maxRows) {
      refs.addButton.style.display = '';
    }
  }
  
  function init() {
    //addRow();
  }
  
  refs.addButton.onclick = (e) => {
    e.preventDefault();
    addRow(true);
  }
  
  init();
}

$(document).ready(function(){
document.querySelectorAll('[data-component="field-repeater"]')
  .forEach(el => {
    fieldRepeaterComponent(el);
  });
})
$(document).on("click", ".repeatable-field__remove-button", function (e) {
    $(this).parent().parent().remove();
});
</script>

@endsection
