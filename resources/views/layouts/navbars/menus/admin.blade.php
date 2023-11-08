<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/live">
                        <i class="ni ni-basket text-success"></i> {{ __('Live Orders') }}<div class="blob red"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">
                        <i class="ni ni-basket text-orange"></i> {{ __('Orders') }}
                    </a>
                </li> -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('colors.index') }}">
                    <i class="ni ni-map-big text-green"></i> {{ __('Images Colors') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('designPatterns.index') }}">
                    <i class="ni ni-map-big text-green"></i> {{ __('Images Design Patterns') }}
                </a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('image.index') }}">
                        <i class="ni ni-shop text-info"></i> {{ __('Images') }}
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manufacturer.index') }}">
                        <i class="ni ni-single-02 text-blue"></i> {{ __('Manufacturer') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('buyer.index') }}">
                        <i class="ni ni-delivery-fast text-pink"></i> {{ __('Buyer') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('request.index') }}">
                        <i class="ni ni-delivery-fast text-pink"></i> {{ __('Request List') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('request.buyer') }}">
                        <i class="ni ni-delivery-fast text-pink"></i> {{ __('Send Request List') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.index') }}">
                        <i class="ni ni-ungroup text-info"></i> {{ __('Pages') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.index') }}">
                        <i class="ni ni-settings text-black"></i> {{ __('Settings') }}
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Laravel Examples') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-planet text-blue"></i> {{ __('Icons') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-pin-3 text-orange"></i> {{ __('Maps') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-key-25 text-info"></i> {{ __('Login') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li>-->
                <!--<li class="nav-item mb-5" style="position: absolute; bottom: 0;">
                    <a class="nav-link" href="/" target="_blank">
                        <i class="ni ni-world"></i> {{ __('Visit Site') }}
                    </a>
                </li>-->
            </ul>
