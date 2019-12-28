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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/carrot.png') }}" alt="Signup Carrot">
                    {{ config('app.name', 'Signup Carrot') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="" class="nav-link">How it works</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Design</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Integrations</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            <div class="jumbotron jumbotron-fluid margin-0 dark-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 vertical-align">
                            <div>
                                <h1>A New Kind Of Popup That Offers Real Value</h1>
                                <p>We make and send beautiful personalised gifts to your subscribers - FOR FREE (+ p&amp;p)</p>
                                <button type="button" class="btn btn-primary">Create My First Carrot</button>
                            </div>
                        </div>
                        <div class="col-md-6 vertical-align">
                            <img src="{{ asset('images/popup1.png') }}" alt="">
                        </div>
                        <div class="col-md-12 jumbo-quote">
                            <p class="quote">
                                <q>Simple. Powerful. Unique.<br>Signup Carrot is changing the game</q>
                            </p>
                            <p class="quote-source">
                                Dave Chamberlain<br>CEO - Arkiplan.co.uk
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid light-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 center">
                            <h2 class="margin-0">Made and sent worldwide</h2>
                            <h3 class="margin-0">Subscribers only pay postage and packaging</h3>
                        </div>
                        <div class="col-md-3">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid grey">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 center">
                            <h2 class="margin-0">Style to match your brand</h2>
                            <h3 class="margin-0">Keyring color options, fonts and merge fields</h3>
                        </div>
                        <div class="col-md-4">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                        <div class="col-md-4">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                        <div class="col-md-4">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid dark-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 center">
                            <h2 class="margin-0">Pricing</h2>
                            <h3 class="margin-0">A subtitle</h3>
                        </div>
                        <div class="col-md-12 center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Free</th>
                                        <th scope="col">Pro</th>
                                        <th scope="col">Enterprise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Carrots</th>
                                        <td>1</td>
                                        <td>5</td>
                                        <td>unlimited</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid grey">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 center">
                            <h2 class="margin-0">We currently integrate with</h2>
                            <h3 class="margin-0">Coming soon</h3>
                            <h4 class="margin-0">Suggest more</h4>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <img src="http://i.imgur.com/I86rTVl.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
</html>