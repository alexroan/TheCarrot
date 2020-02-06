@extends('layouts.app')

@section('content')

<div class="home fade" style="opacity:0;">
    @include('cookieConsent::index')
    <div id="jumbotron" class="jumbotron jumbotron-fluid" style="background-image: url('{{ asset('images/happy-customer-small.jpg') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div>
                        <h1 class="display-4">Convert more visitors into susbcribers than <strong>ever before</strong></h1>
                        <p class="lead">Engage more with your customers. Incentivise visitors to signup to your email list 
                            by offering a free personalised product. Sent by us, attributed to you.</p>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Start Converting</a>
                            <a class="btn btn-link btn-lg" href="#integrations" role="button">Find Out More</a>
                        </p>
                        <p class="font-weight-light">Free 7 Day Trial - No Card Required</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-6 text-center justify-content-center">
                    <img class="img-fluid wireframe" src="{{ asset('images/home-page-wireframe-pop.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <section id="integrations" class="container-fluid py-md-5 bg-white">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-12 text-center">
                    <h3>Integrate with any web platform or CMS</h3>
                </div>
            </div>
            <div class="row py-4 align-items-center justify-content-center">
                <div class="col-6 col-md-2">
                    <img src="{{ asset('images/mailchimp-logo.png') }}" alt="Mailchimp">
                </div>
                <div class="col-6 col-md-2">
                    <img src="{{ asset('images/wordpress-logo.png') }}" alt="Wordpress">
                </div>
                <div class="col-6 col-md-2">
                    <img src="{{ asset('images/shopify-logo.png') }}" alt="Shopify">
                </div>
                <div class="col-6 col-md-2">
                    <img src="{{ asset('images/joomla-logo.png') }}" alt="Joomla">
                </div>
                <div class="col-6 col-md-2">
                    <img src="{{ asset('images/squarespace-logo.png') }}" alt="Squarespace">
                </div>
            </div>
        </div>
    </section>

    <section id="why" class="container-fluid py-md-5">
        <div class="container">
            <div class="row py-4 text-center">
                <h3 class="col-12 col-md-10 offset-md-1">Engage and capture more subscribers to your brand</h3>
                <p class="lead col-12 col-md-8 offset-md-2">Growing an email list can be hard, but no online marketing strategy is complete without one. 
                    We engage more visitors so you can increase your revenue.</p>
            </div>
        </div>
    </section>

    <section id="background" class="container-fluid py-md-5">
        <div class="container">
            <div class="row py-4 text-center justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <img class="img-fluid w-50" src="{{ asset('images/email-icon.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <h3>Email marketing beats the rest</h3>
                    <p class="lead">Everyone opens their emails. Not everyone clicks every ad they see.
                        Growing a large subscriber base vastly outweighs investing in Pay Per Click, Content Marketing, or SEO.</p>
                </div>
            </div>
            <div class="row py-4 text-center justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-last order-md-first">
                    <h3>Growing an email list is hard</h3>
                    <p class="lead">Very few visitors see your subscribe form, let alone actually subscribe.
                        Banners and popups increase conversion slightly, but the rate remains painfully small per visitor.</p>
                </div>
                <div class="col-12 col-md-6 order-first">
                    <img class="img-fluid w-50" src="{{ asset('images/growth-icon.png') }}" alt="">
                </div>
            </div>
            <div class="row py-4 text-center justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <img class="img-fluid w-50" src="{{ asset('images/opportunity-icon.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <h3>Every visitor that doesn't subscribe is a missed opportunity</h3>
                    <p class="lead">Without growing your email list effectively, 
                        you are not engaging with your customers as well as you could be.
                        Both you and your customer benefit from a direct line of communication.
                        This is where Signup Carrot can help.
                    </p>
                </div>                
            </div>
        </div>
    </section>

    <section id="fix" class="container-fluid py-md-5">
        <div class="container">
            <div class="row py-4 text-center justify-content-center">
                <div class="col-12 order-last order-md-first">
                    <h3 class="col-12 col-md-10 offset-md-1">Increase your conversion and engage your customers</h3>
                    <p class="lead col-12 col-md-8 offset-md-2">Make your visitors feel valued and part of your brand.
                        Signup Carrot enables you to offer a free, personalised, engraved, physical gift in exchange for subscribing. 
                        Proven to increase subscribe rate.
                    </p>
                </div>
                <div class="col-12 order-first">
                    <img class="img-fluid w-25 w-md-50 h-100" src="{{ asset('images/conversion-icon.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="how" class="container-fluid py-md-5">
        <div class="container">
            <div class="row py-4 text-center justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <img class="img-fluid w-50" src="{{ asset('images/gift-icon.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <h3>We send your subscribers a free personalised gift when they subscribe to YOUR email list</h3>
                    <p class="lead">Using a personalised gift incentive, visitors are twice as likely to subscribe compared to a basic subscribe popup.
                        We do not store your subscribers email addresses ourselves, they go straight to you.
                    </p>
                </div>
            </div>
            <div class="row py-4 text-center justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-last order-md-first">
                    <h3>Easy to implement, set it and forget it</h3>
                    <p class="lead">Once you create your Carrot, we give you a piece of code which goes in the head tag of your site. 
                        There, your visitors will start subscribing. Every time they do, they receive a free personalised gift from us, attributed to YOUR brand.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-first">
                    <img class="img-fluid w-50" src="{{ asset('images/easy-icon.png') }}" alt="">
                </div>
            </div>
            <div class="row py-4 text-center justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <img class="img-fluid w-50" src="{{ asset('images/first-product-icon.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <h3>The first to offer a physical personalised product in exchange for subscribing</h3>
                    <p class="lead">No other email subscription popup provider offers an incentive as enticing as this.
                        Proven to be more efficient than basic popups and discount offers.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="results" class="container-fluid py-md-5 bg-white">
        <div class="container">
            <div class="row py-4 text-center">
                <h3 class="col-12 col-md-8 offset-md-2">Proven results against existing solutions</h3>
            </div>
        </div>
    </section>

    <section id="results2" class="container-fluid py-md-5">
        <div class="container">
            <div class="row py-4 text-center justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-last order-md-first">
                    <h3>Using Signup Carrot increased our subscribe rate by 75&percnt;&excl;</h3>
                    <p class="lead">
                        "Tested against a "10&percnt; Off Your Next Order" email popup,
                        we increased the percentage of visitors subscribing by 75&percnt; by using SignupCarrot." - <i>DustAndThings.com</i>
                    </p>
                </div>
                <div class="col-12 col-md-6 order-first">
                    <img class="img-fluid w-50" src="{{ asset('images/75increase.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="#jumbotron2" class="container-fluid py-5 bg-dark text-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div>
                        <h1 class="display-4">Do you want to convert more visitors into susbcribers than <strong>ever before?</strong></h1>
                        <p class="lead"></p>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Start Converting</a>
                            <a class="btn btn-link btn-lg" href="mailto:info@signupcarrot.com" role="button">Contact Us</a>
                        </p>
                        <p class="font-weight-light">Free 7 Day Trial - No Card Required</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-6 text-center justify-content-center">
                    <img class="img-fluid wireframe" src="{{ asset('images/home-page-wireframe-pop.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
</div>
@endsection