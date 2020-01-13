<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/dustandthings-favicon.ico') }}' />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Subscribed! Confirm Free Gift') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- TrustBox script --> 
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script> 
    <!-- End TrustBox script -->
    
</head>
<body id="body">
    <div id="app">
        <main>
            <section class="container-fluid py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-success text-center">
                                <h3>THANK YOU FOR SUBSCRIBING</h3>
                                <h4>Order your free personalised gift</h4>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Basket
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <img style="height: 8rem;" id="product-image" src="{{ asset($selectedProduct->image) }}">
                                        </div>
                                        <div class="col-md-8">
                                            <form method="get" action="confirm" id="confirm-form" name="confirm-form">
                                                <input type="hidden" name="signupcarrot-email" value="{{ $email }}">
                                                <input type="hidden" name="signupcarrot-id" value="{{ $carrotId }}">
                                                <input type="hidden" name="product-select" value="{{ $selectedProduct->product_id }}">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="product-placeholder">Product:</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input disabled class="form-control" name="product-placeholder" value="{{ $selectedProduct->name }}" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label required class="col-form-label" for="name-on-product">Name on Product:</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input value="{{ $nameOnProduct }}" class="form-control" maxlength="12" type="text" name="name-on-product" id="name-on-product">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>                                    
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <p class="card-text">
                                                Order Fulfilled by DustAndThings.com
                                            </p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <img width="50%" src="{{ asset('images/dustandthings.png') }}" alt="">
                                        </div>
                                        <div class="col-md-2 offset-md-2 text-center">
                                            <!-- TrustBox widget - Mini --> 
                                            <div class="trustpilot-widget" data-locale="en-GB" data-template-id="53aa8807dec7e10d38f59f32" data-businessunit-id="5abcba963bb2c6000179c496" data-style-height="150px" data-style-width="100%" data-theme="light">
                                                <a href="https://uk.trustpilot.com/review/dustandthings.com" target="_blank" rel="noopener">
                                                    Trustpilot
                                                </a>
                                            </div>
                                            <!-- End TrustBox widget -->
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <p class="card-text"><small class="text-muted">By clicking proceed, you will be redirected to dustandthings.com checkout page</small></p>
                                            <input class="btn btn-lg btn-primary" form="confirm-form" type="submit" value="Proceed to Checkout">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>