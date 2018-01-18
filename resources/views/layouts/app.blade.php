<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="navbar-background">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="fa fa-times"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-left navbar-logo" href="{{ url('/') }}">
                        <img src="/img/logo-header.png" alt="Logo">
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
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
