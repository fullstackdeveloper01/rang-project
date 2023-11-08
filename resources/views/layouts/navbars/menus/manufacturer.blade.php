<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="ni ni-tv-2 text-primary"></i> {{ __('Home') }}
        </a>
    </li>
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
            <i class="ni ni-map-big text-green"></i> {{ __('My Images') }}
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
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="ni ni-single-02 text-orange"></i> {{ __('My profile') }}
        </a>
    </li>
    <!--<li class="nav-item mb-5" style="position: absolute; bottom: 0;">
        <a class="nav-link" href="/" target="_blank">
            <i class="ni ni-world"></i> {{ __('Visit Site') }}
        </a>
    </li>-->
</ul>
