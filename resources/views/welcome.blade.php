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
                                <h1>Grow Your Email List By Offering Real Value</h1>
                                <p>Convert more visitors into subscribers by sending beautiful personalised gifts - FOR FREE (+ p&amp;p)</p>
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

            <section class="container-fluid white py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 center">
                            <h2 class="margin-0">Make Your Carrot</h2>
                            <h3 class="margin-0">Design Your Popup To Match Your Brand</h3>
                            <h4 class="margin-0">Integrate Your Email List Provider</h4>
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
            </section>

            <section class="container-fluid green py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 center">
                            <h2 class="margin-0">Add To Your Site</h2>
                            <h3 class="margin-0">We Integrate With Blogging And Commerce Platforms Like Wordpress and Shopify</h3>
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
            </section>

            <section class="container-fluid dark-grey py-5 pricing">
                <div class="container">
                    <div class="row">
                        <!-- Free Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
                                <h6 class="card-price text-center">&pound;0<span class="period">/month</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Single Carrot</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>5000 monthly subscribers</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Mail Integrations</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Blog &amp; Commerce Integrations</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Single Product Offering</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Analytics</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Extended Product Offerings</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Remove Carrot Branding</li>
                                </ul>
                                <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                            </div>
                            </div>
                        </div>
                        <!-- Plus Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                <h6 class="card-price text-center">&pound;99<span class="period">/month</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>5 Carrots</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>25000 monthly subscribers</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Mail Integrations</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Blog &amp; Commerce Integrations</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Single Product Offering</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Analytics</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Extended Product Offerings</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Remove Carrot Branding</li>
                                </ul>
                                <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                            </div>
                            </div>
                        </div>
                        <!-- Pro Tier -->
                        <div class="col-lg-4">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Enterprise</h5>
                                <h6 class="card-price text-center">Contact Us</h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Carrot</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited monthly subscribers</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Mail Integrations</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Blog &amp; Commerce Integrations</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Single Product Offering</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Analytics</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Extended Product Offerings</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Remove Carrot Branding</li>
                                </ul>
                                <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-fluid orange py-5">
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
            </section>

        </main>
    </div>
</body>
</html>