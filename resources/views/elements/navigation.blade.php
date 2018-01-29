<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-left navbar-logo" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-header.png') }}" alt="Logo">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a class="nav-link" href="/">{{ __('navigation.home') }}</a></li>
                <li><a class="nav-link" href="/{{ $locale }}/events">{{ __('navigation.events') }}</a></li>
                <li><a class="nav-link" href="/{{ $locale }}/news">{{ __('navigation.news') }}</a></li>
                <li><a class="nav-link" href="/{{ $locale }}/prices">{{ __('navigation.prices') }}</a></li>
                <li><a class="nav-link" href="/{{ $locale }}/contact">{{ __('navigation.contact') }}</a></li>
            </ul>
        </div>
    </div>
</nav>