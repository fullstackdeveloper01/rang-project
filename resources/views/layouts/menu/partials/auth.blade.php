<a href="#" class="btn btn-neutral btn-icon web-menu" data-toggle="dropdown" role="button">
    <span class="btn-inner--icon">
        <i class="fa fa-user mr-2"></i>
      </span>
    <span class="nav-link-inner--text">{{ Auth::user()->name }}</span>
</a>
<a href="#" class="nav-link nav-link-icon mobile-menu" data-toggle="dropdown" role="button">
    <span class="btn-inner--icon">
        <i class="fa fa-user mr-2"></i>
      </span>
    <span class="nav-link-inner--text">{{ Auth::user()->name }}</span>
</a>
<div class="dropdown-menu">
    <a href="/profile" class="dropdown-item">{{ __('Profile') }}</a>
    @role('admin')
        <a href="/home" class="dropdown-item">{{ __('Dashboard') }}</a> 
        <a href="{{ route('image.index') }}" class="dropdown-item">{{ __('Images') }}</a>
        <a href="{{ route('manufacturer.index') }}" class="dropdown-item">{{ __('Manufacturer') }}</a>
        <a href="{{ route('buyer.index') }}" class="dropdown-item">{{ __('Buyer') }}</a>
        <a href="/pages" class="dropdown-item">{{ __('Pages') }}</a>
        <a href="/settings" class="dropdown-item">{{ __('Settings') }}</a>
    @endrole
    <!-- @role('owner')
        <a href="/home" class="dropdown-item">{{ __('Dashboard') }}</a>
        <a class="dropdown-item " href="/live">{{ __('Live Orders') }}</a>
        <a href="/orders" class="dropdown-item">{{ __('Orders') }}</a>
        <a href="{{ route('restorants.edit', auth()->user()->restorant->id) }}" class="dropdown-item">{{ __('Restaurant') }}</a>
        <a href="/items" class="dropdown-item">{{ __('Menu') }}</a>
    @endrole -->
    @role('manufacturer')
    <a href="{{ route('image.index') }}" class="dropdown-item">{{ __('My Images') }}</a>
    <a href="#" class="dropdown-item">{{ __('Request List') }}</a>
    @endrole
    @role('buyer')
        <a href="#" class="dropdown-item">{{ __('Request List') }}</a>
    @endrole
   <!-- <a href="/logout" class="dropdown-item">Logout</a>-->
   <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <span>{{ __('Logout') }}</span>
    </a>
</div>

<!-- <a href="/home" target="_blank" class="btn btn-neutral btn-icon">
    <span class="btn-inner--icon">
      <i class="fa fa-user mr-2"></i>
    </span>
    <span class="nav-link-inner--text">Profile</span>
  </a> -->
