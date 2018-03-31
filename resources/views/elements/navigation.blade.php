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
                <?php
                    $links = [
                        [ 'href' => "/", 'pattern' => '/', 'label' => __('navigation.home') ],
                        [ 'href' => "/$locale/events", 'pattern' => '*/events', 'label' => __('navigation.events') ],
                        [ 'href' => "/$locale/news", 'pattern' => '*/news', 'label' => __('navigation.news') ],
                        [ 'href' => "/$locale/prices", 'pattern' => '*/prices', 'label' => __('navigation.prices') ],
                        [ 'href' => "/$locale/contact", 'pattern' => '*/contact', 'label' => __('navigation.contact') ],
                    ];
                ?>
                @foreach($links as $link)
                    <li>
                    @if(Request::is($link['pattern']))
                        <a class="nav-link active" href="{{ $link['href']  }}">{{ $link['label'] }}</a>
                    @else
                        <a class="nav-link" href="{{ $link['href']  }}">{{ $link['label'] }}</a>
                    @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>