@extends('layouts.app', ['title' => __('Requests')])

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
                                <h3 class="mb-0">{{ __('Requests') }}</h3>
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
                                    <!-- <th scope="col">{{ __('Image') }}</th>   -->
                                    <th scope="col">{{ __('Buyer Name') }}</th> 
                                    <th scope="col">{{ __('Fabric Type') }}</th>  
                                    <th scope="col">{{ __('Width Type') }}</th>  
                                    <th scope="col">{{ __('GSM Count') }}</th>  
                                    <th scope="col">{{ __('Design Quantity') }}</th>  
                                    <th scope="col">{{ __('Measurement') }}</th>    
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Request Status') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($requests)
                                    @foreach ($requests as $request)
                                        <tr> 
                                            
                                            @if($request->get_buyer)
                                                <td>{{ $request->get_buyer->name }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>
                                                @if($request->get_fabric)
                                                    {{ $request->get_fabric->name }}
                                                @endif
                                            </td>
                                            <td>{{ $request->width_type }}</td>
                                            <td>{{ $request->gsm_count }}</td>
                                            <td>{{ $request->measurement }}</td>
                                            <td>{{ $request->design_quantity }}</td>
                                             <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($request->manuf_status == 0)
                                                    <span class="badge badge-primary">{{ __('Pending') }}</span>
                                                @elseif($request->manuf_status == 1)
                                                    <span class="badge badge-success">{{ __('Accept') }}</span>
                                                @elseif($request->manuf_status == 2)
                                                    <span class="badge badge-warning">{{ __('Reject') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->status == 0)
                                                    <span class="badge badge-primary">{{ __('Pending') }}</span>
                                                @elseif($request->status == 1)
                                                    <span class="badge badge-success">{{ __('Awarded') }}</span>
                                                @elseif($request->status == 2)
                                                    <span class="badge badge-warning">{{ __('Reject') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                
                                                        <a class="dropdown-item" href="{{ route('request.view', $request->id) }}">{{ __('View') }}</a>
                                                        @if($request->status != 1 && $request->manuf_status != 1 ) 
                                                            @if($request->manuf_status == 2)
                                                                <a class="dropdown-item" href="{{ route('request_status', [$request->id, 1]) }}">{{ __('Accept') }}</a>
                                                            @else
                                                                <a class="dropdown-item" href="{{ route('request_status', [$request->id, 1]) }}">{{ __('Accept') }}</a>
                                                                <a class="dropdown-item" href="{{ route('request_status', [$request->id, 2]) }}">{{ __('Reject') }}</a>                                                            
                                                            @endif
                                                        @endif
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
                            {{ $requests->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
