@extends('layouts.app', ['title' => __('Colors')])

@section('content')
    
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Colors') }} ({{$colors->total()}})</h3>
                            </div>
                         
                                <div class="col-4 text-right">
                                    <a href="{{ route('colors.create') }}" class="btn btn-sm btn-primary">{{ __('Add Color') }}</a>
                                
                                </div> 
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive"> 
                            
                           
                       
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr> 
                                    <th scope="col">{{ __('Name') }}</th>
                                    @if(auth()->user()->hasRole('admin'))
                                    <th scope="col">{{ __('Author Name') }}</th>
                                    @endif  
                                    <th scope="col">{{ __('Color Code') }}</th >
                                    <th scope="col">{{ __('Active') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($colors) > 0)
                                    @foreach($colors as $color)
                                        <tr>
                                            <td>{{ $color->name }}</td>
                                            @if(auth()->user()->hasRole('admin') && $color->user)
                                                <td>{{ $color->user->name }}</td>
                                            @endif 
                                             <td>{{ $color->code }}</td>
                                            <td>
                                            @if($color->status == 1)
                                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                            @else
                                                    <span class="badge badge-warning">{{ __('Not active') }}</span>
                                            @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                        <form action="{{ route('colors.destroy', $color) }}" method="post">
                                                            @csrf
                                                            @method('delete') 
                                                            <a class="dropdown-item" href="{{ route('colors.edit', $color) }}">{{ __('Edit') }}</a>
                                                           
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this color?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>

                                                    </div> 

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $colors->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
