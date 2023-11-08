@extends('layouts.app', ['title' => __('Request View')])

@section('content')
    @include('restorants.partials.modals')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Requests') }} #{{$request->id}}</h3>
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

                    <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table align-items-center table-flush">

                                <tbody> 

                                    <tr>

                                        <th scope="col">{{ __('Buyer Name') }}</th>

                                        @if($request->get_buyer)
                                            <td>{{ $request->get_buyer->name }}</td>
                                        @else
                                            <td></td>
                                        @endif

                                    </tr>

                                    <tr>

                                        <th scope="col">{{ __('Buyer Email') }}</th>

                                        @if($request->get_buyer)
                                            <td>{{ $request->get_buyer->email }}</td>
                                        @else
                                            <td></td>
                                        @endif

                                    </tr>

                                    
                                    <tr>

                                        <th scope="col">{{ __('Fabric Type') }}</th>

                                        <td>
                                            @if($request->get_fabric)
                                                {{ $request->get_fabric->name }}
                                            @endif
                                        </td>

                                    </tr>  

                                    <tr>

                                        <th scope="col">{{ __('Width Type') }}</th>

                                        <td>{{ $request->width_type }}</td>

                                    </tr>  
                                    <tr>

                                        <th scope="col">{{ __('Open Width in inches') }}</th>

                                        <td>{{ $request->open_width_inches }}</td>

                                    </tr>  
                                    <tr>

                                        <th scope="col">{{ __('Tubular in inches') }}</th>

                                        <td>{{ $request->tubular_inches }}</td>

                                    </tr>  

                                    <tr>

                                        <th scope="col">{{ __('Width Type') }}</th>

                                        <td>{{ $request->width_type }}</td>

                                    </tr>  
                                    <tr>

                                        <th scope="col">{{ __('GSM Count') }}</th>

                                        <td>{{ $request->gsm_count }}</td>

                                    </tr>  
                                    <tr>

                                        <th scope="col">{{ __('Design Quantity') }}</th>

                                        <td>{{ $request->design_quantity }}</td>

                                    </tr>  
                                    <tr>

                                        <th scope="col">{{ __('Measurement') }}</th>

                                        <td>{{ $request->measurement }}</td>

                                    </tr>  
                                    <tr>

                                        <th scope="col">{{ __('Creation Date') }}</th>

                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>

                                    </tr>  
                                    <tr>
                                        <th scope="col">{{ __('Request Status') }}</th>
                                        <td>

                                            @if($request->status == 0)
                                                    <span class="badge badge-info">{{ __('Pending') }}</span>
                                            @elseif($request->status == 1)
                                                    <span class="badge badge-success">{{ __('Awarded') }}</span>
                                            @elseif($request->status == 2)
                                                <span class="badge badge-warning">{{ __('Reject') }}</span>
                                            @endif

                                        </td>
                                    </tr> 

                                    @if(auth()->user()->hasRole('manufacturer'))  
                                    <tr>
                                        <th scope="col">{{ __('Status') }}</th>
                                        <td>

                                            @if($user_manufacturer)

                                                @if($user_manufacturer->status == 0)
                                                        <span class="badge badge-info">{{ __('Pending') }}</span>
                                                @elseif($user_manufacturer->status == 1)
                                                        <span class="badge badge-success">{{ __('Accept') }}</span>
                                                @elseif($user_manufacturer->status == 2)
                                                    <span class="badge badge-warning">{{ __('Reject') }}</span>
                                                @endif

                                            @endif

                                        </td>
                                    </tr>   
                                    @endif
                                </tbody>

                            </table>

                        </div>

                    </div>

                </div> 
                </br>

            <div class="table-responsive">
                 
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                        <h3 class="mb-0">{{ __('Request Items') }}</h3>
                        </div> 
                    </div>
                </div>
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Image') }}</th>   
                            <th scope="col">{{ __('Manufacturer Name') }}</th> 
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($request->get_requestItmes)
                            @foreach ($request->get_requestItmes as $items)
                                <tr> 
                                    
                                    @if($items->get_image)
 
                                        <td>
                                            <img class="rounded" src="{{ asset('uploads') }}/{{ $items->get_image->logo }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" width="50px" height="50px"></img>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif

                                    @if($items->get_manufacturer)
                                        <td>{{ $items->get_manufacturer->name }}</td>
                                    @else
                                        <td></td>
                                    @endif 
                                    
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('buyer'))
                <div class="table-responsive">

                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                            <h3 class="mb-0">{{ __('Manufacturer List') }}</h3>
                            </div> 
                        </div>
                    </div>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Image') }}</th>   
                                <th scope="col">{{ __('Manufacturer Name') }}</th>
                                <th scope="col">{{ __('Phone Number') }}</th>  
                                <th scope="col">{{ __('Manufacturer Status') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($request->get_requestManufacturer)
                                @foreach ($request->get_requestManufacturer as $requestManufacturer)
                                    <tr> 
                                        
                                        @if($requestManufacturer->get_manufacturer)

                                            <td>
                                                <img class="rounded" src="{{ asset('uploads') }}/{{ $requestManufacturer->get_manufacturer->profile_image }}" onerror="this.onerror=null;this.src='{{ asset('uploads') }}/no-image.png';" width="50px" height="50px"></img>
                                            </td>
                                            <td>{{ $requestManufacturer->get_manufacturer->name }}</td>
                                            <td>{{ $requestManufacturer->get_manufacturer->phone }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif   
                                        <td>
                                            @if($requestManufacturer->status == 0)
                                                <span class="badge badge-info">{{ __('Pending') }}</span>
                                            @elseif($requestManufacturer->status == 1)
                                                <span class="badge badge-success">{{ __('Accept') }}</span>

                                                @if(auth()->user()->hasRole('buyer'))
                                                    @if($requestManufacturer->is_accept == 1)
                                                        <span class="badge badge-primary">{{ __('Awarded') }}</span>
                                                    @else
                                                        @if($request->status != 1)
                                                            <a class="badge badge-info" href="{{ route('request_accept', [$request->id, $requestManufacturer->id]) }}">{{ __('Award') }}</a>
                                                        @endif
                                                    @endif

                                                @endif 
                                            @elseif($requestManufacturer->status == 2)
                                                <span class="badge badge-warning">{{ __('Reject') }}</span>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @endif
           
        </div>
    </div>
</div>

        @include('layouts.footers.auth')
    </div>
@endsection
