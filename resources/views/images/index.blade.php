@extends('layouts.app', ['title' => __('Images')])

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
                                <h3 class="mb-0">{{ __('Images') }} ({{$images->total()}})</h3>
                            </div>
                            @if(auth()->user()->hasRole('manufacturer') || auth()->user()->hasRole('admin'))
                                <div class="col-4 text-right">
                                    <a href="{{ route('image.create') }}" class="btn btn-sm btn-primary">{{ __('Add Images') }}</a>
                                
                                    <a href="{{ route('image.addbulk') }}" class="btn btn-sm btn-primary">{{ __('Add Bulk Images') }}</a>
                                </div>
                            @endif
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
                        @if(!empty($user_id))
                            <form action="{{ route('manufacturer_profile', $user_id) }}">
                                <div id="teamleadtable_filter" class="dataTables_filter" style="float: right;">
                                    <label>Search:<input type="search" name="search" value="{{$search}}" class="" placeholder="" aria-controls="">
                                    <button type="submit" id="btnexample_search" class="btn btn-success">Search</button>
                                    </label>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('image.index') }}">
                                <div id="teamleadtable_filter" class="dataTables_filter" style="float: right;">
                                    <label>Search : <input type="search" name="search" value="{{$search}}" class="" placeholder="" aria-controls="">
                                    <button type="submit" id="btnexample_search" class="btn btn-success">Search</button>
                                    </label>
                                </div>
                            </form> 
                        @endif
                        
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Image') }}</th>  
                                    <th scope="col">{{ __('Name') }}</th>
                                    @if(auth()->user()->hasRole('admin'))
                                    <th scope="col">{{ __('Manufacturer Name') }}</th>
                                    @endif  
                                    <th scope="col">{{ __('Color') }}</th>  
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col">{{ __('Active') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($images)
                                    @foreach($images as $image)
                                        <tr>
                                            <td><img class="rounded" src="{{ asset('uploads') }}/{{ $image->logo }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" width="50px" height="50px"></img></td>
                                            <td>{{ $image->name }}</td>
                                            @if(auth()->user()->hasRole('admin'))
                                                <td>{{ $image->user->name }}</td>
                                            @endif
                                            <td>
                                                @if($image->getColors)
                                                       @php
                                                        if(!empty($image->getColors))
                                                        {
                                                            foreach($image->getColors as $keys => $dataColor)
                                                            {
                                                                echo $dataColor['name'].", ";
                                                            }
                                                        }
                                                       @endphp
                                                @endif
                                                </td>
                                             <td>{{ $image->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                            @if($image->status == 1)
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

                                                        <form action="{{ route('image.destroy', $image) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            @if($image->status == 0)
                                                                <a class="dropdown-item" href="{{ route('image.activate', $image) }}">{{ __('Activate') }}</a>
                                                            @endif
                                                            @if(auth()->user()->hasRole('manufacturer'))
                                                                <a class="dropdown-item" href="{{ route('image.edit', $image) }}">{{ __('Edit') }}</a>
                                                            @endif
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Deactivate') }}
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
                            {{ $images->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
