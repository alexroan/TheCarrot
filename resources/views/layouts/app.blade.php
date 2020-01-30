<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Signup Carrot') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ config('app.url') }}">
    <meta name="twitter:creator" content="@alexroan">
    <meta name="twitter:title" content="Signup Carrot">
    <meta name="twitter:description" content="Grow Your Email List By Providing Real Value To Your Visitors">
    <meta name="twitter:image" content="{{ asset('images/carrotlogo.png') }}">

    <meta property="og:url"                content="{{ config('app.url') }}" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Signup Carrot" />
    <meta property="og:description"        content="Grow Your Email List By Providing Real Value To Your Visitors" />
    <meta property="og:image"              content="{{ asset('images/carrotlogo.png') }}" />

    <!-- <script src='https://signupcarrot.com/popups/carrots/compiled/3.js'></script> -->
    <!-- <script src='http://thecarrot.local/popups/carrots/compiled/1.js'></script> -->

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default fixed-top navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/carrot.png') }}" alt="Signup Carrot">
                    {{ config('app.name', 'Signup Carrot') }} {{ __('Beta')}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @stack('pagelinks')

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Signup') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else

                            @php
                                $isAdmin = Auth::user()->admin;
                            @endphp
                            @if ($isAdmin == true)
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="{{ route('admin') }}">{{ __('Admin') }}</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ route('contact') }}">{{ __('Contact Us') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
