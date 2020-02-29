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
        <main class="mt-5">
            <section class="container-fluid">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
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
                                        <form class="w-100" method="get" action="confirm" id="confirm-form" name="confirm-form">
                                            <input type="hidden" name="signupcarrot-email" value="{{ $email }}">
                                            <input type="hidden" name="signupcarrot-id" value="{{ $carrotId }}">
                                            <input type="hidden" name="product-select" value="{{ $selectedProduct->product_id }}">
                                            <input type="hidden" name="product-placeholder" value="{{ $selectedProduct->name }}">

                                            <table class="table">
                                                <thead>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Engraving</th>
                                                    <th scope="col">Price</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><img style="max-height: 8rem;" id="product-image" src="{{ asset($selectedProduct->image) }}"></td>
                                                        <td>{{ $selectedProduct->name }}</td>
                                                        <td><input value="{{ $nameOnProduct }}" class="form-control" maxlength="12" type="text" name="name-on-product" id="name-on-product"></td>
                                                        <td><p class="mb-0"><del class="text-danger">&pound;6.95</del</p><p>&pound;0.00</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Postage charge</td>
                                                        <td></td>
                                                        <td>&pound;1.49</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th scope="row">TOTAL</th>
                                                        <td></td>
                                                        <th scope="row">&pound;1.49</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>                                 
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