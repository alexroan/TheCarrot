@extends('layouts.app')

@section('content')
<div class="home">
    @include('cookieConsent::index')
    <div id="jumbotron" class="jumbotron jumbotron-fluid margin-0 dark-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-6 vertical-align">
                    <div>
                        <h1>Grow Your Email List By Offering Real Value</h1>
                        <p>Convert more visitors into subscribers by sending beautiful personalised gifts - FOR FREE (+ p&amp;p)</p>
                        <a href="{{ route('register') }}" role="button" class="btn btn-primary">Create My First Carrot</a>
                    </div>
                </div>
                <div class="col-md-6 vertical-align">
                    <img src="{{ asset('images/screen1.png') }}" alt="">
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

    <section id="works" class="container-fluid white py-5 works">
        <div class="container">
            <div class="col-md-12 center">
                <h2 class="header-primary margin-0">HOW IT WORKS</h2>
                <h4 class="bold">INCENTIVISE YOUR USERS TO SUBSCRIBE</h4>
            </div>
            <div class="row">
                <div class="col-md-6 image-pane">
                    <img src="{{ asset('images/screen1.png') }}" alt="">
                    <img class="arrow" src="{{ asset('images/arrow.png') }}" alt="">
                </div>
                <div class="col-md-6 vertical-align center">
                    <h4>Your customized Signup Carrot pops up, with free personalised keyring incentive</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 image-pane">
                    <img src="{{ asset('images/screen2.png') }}" alt="">
                    <img class="arrow" src="{{ asset('images/arrow.png') }}" alt="">
                </div>
                <div class="col-md-6 vertical-align center">
                    <h4>Subscriber enters their email address and is subscribed to your email list.</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 image-pane">
                    <img src="{{ asset('images/screen3.png') }}" alt="">
                    <img class="arrow" src="{{ asset('images/arrow.png') }}" alt="">
                </div>
                <div class="col-md-6 vertical-align center">
                    <h4>Subscriber pays small postage and package charge.</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 image-pane">
                    <img src="{{ asset('images/screen4.png') }}" alt="">
                    <img class="arrow" src="{{ asset('images/arrow.png') }}" alt="">
                </div>
                <div class="col-md-6 vertical-align center">
                    <h4>Keyring order is sent to our workshop where we make and fulfil it.</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 image-pane">
                    <img src="{{ asset('images/screen5.png') }}" alt="">
                </div>
                <div class="col-md-6 vertical-align center">
                    <h4>Keyring is received in blank packaging within 3 days!</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 center">
                    <a href="{{ route('register') }}" role="button" class="btn btn-primary margin-top">TRY IT OUT</a>
                </div>
            </div>
        </div>
    </section>

    <section id="integrations" class="container-fluid green py-5 integrations">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="">EASY INTEGRATION</h2>
                </div>
                <div class="col-md-6 integration-logos">
                    <img src="{{ asset('images/mailchimp-logo.png') }}" alt="Mailchimp">
                    <img src="{{ asset('images/wordpress-logo.png') }}" alt="Wordpress">
                    <img src="{{ asset('images/shopify-logo.png') }}" alt="Shopify">
                </div>
                <div class="col-md-6 vertical-align">
                    <div>
                        <h4>Integrate your email list and add to your platform seamlessly</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 center">
                    <a href="{{ route('register') }}" role="button" class="btn btn-primary btn-orange margin-top">GET STARTED NOW</a>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="container-fluid dark-grey py-5 pricing">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="header-secondary margin-0">PRICING</h2>
                    <!-- <h4 class="header-white bold">EVERY NEW ACCOUNT IS FREE</h4> -->
                </div>
                <!-- Free Tier -->
                <div class="col-md-4">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body emphasis">
                            <h5 class="card-title text-muted text-uppercase text-center">Basic</h5>
                            <h6 class="card-price text-center">&pound;12<span class="period">/month</span></h6>
                            <hr>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Single Carrot</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>5000 monthly subscribers</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mail Integrations</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Blog &amp; Commerce Integrations</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Single Product Offering</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Analytics</li>
                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Extended Product Offerings</li>
                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Remove Signup Carrot Branding</li>
                            </ul>
                            <a href="{{ route('register') }}" role="button" class="btn btn-block btn-primary text-uppercase">SIGNUP</a>
                        </div>
                    </div>
                </div>
                <!-- Plus Tier -->
                <div class="col-md-4">
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
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Remove Signup Carrot Branding</li>
                            </ul>
                            <a href="{{ route('register') }}" role="button" class="btn btn-block btn-primary text-uppercase">SIGNUP</a>
                        </div>
                    </div>
                </div>
                <!-- Pro Tier -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-muted text-uppercase text-center">Enterprise</h5>
                            <h6 class="card-price text-center">Contact Us</h6>
                            <hr>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Carrots</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited monthly subscribers</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mail Integrations</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Blog &amp; Commerce Integrations</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Single Product Offering</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Analytics</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Extended Product Offerings</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Remove Signup Carrot Branding</li>
                            </ul>
                            <a href="{{ route('register') }}" role="button" class="btn btn-block btn-primary text-uppercase">SIGNUP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="container-fluid orange py-5 faq">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2>FAQ</h2>
                </div>
                <div id="accordionExample" class="col-md-12 accordion">
                    @foreach ($faqs as $faq)
                        <div class="card">
                            <div class="card-header" id="heading-{{ $faq->id }}">
                                <h5 class="mb-0">
                                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapse-{{ $faq->id }}" aria-expanded="true" aria-controls="collapse-{{ $faq->id }}">
                                        <h4 class="margin-0 header-black uppercase">{{ $faq->question }}</h4>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse-{{ $faq->id }}" class="collapse" aria-labelledby="heading" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 center">
                    <a href="{{ route('register') }}" role="button" class="btn btn-primary margin-top">START CREATING</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="container-fluid dark-grey py-5 footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li><a href="#works">How It Works</a></li>
                        <li><a href="#integrations">Integration</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="mailto:info@signupcarrot.com">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-12">
                    Copyright &copy; {{ now()->year }} All Rights Reserved By Signup Carrot
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection