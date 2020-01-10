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

    <script type="application/javascript" >
        function setProductImage() {
            var select = document.getElementById("product-select");
            var image = select.options[select.selectedIndex].getAttribute('data-image');
            document.getElementById("product-image").setAttribute('src', image);
        }
    </script>
    
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
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="product-select">Product:</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select onChange="setProductImage()" class="form-control browser-default custom-select" name="product-select" id="product-select">
                                                        @foreach ($products as $product)
                                                            @php
                                                                $id = $product->product_id;
                                                                $image = asset($product->image);
                                                                $selected = "";
                                                                if ($id == $selectedProduct->product_id) {
                                                                    $selected = "selected";
                                                                }
                                                            @endphp
                                                            <option {{$selected}} data-image="{{ $image }}" value="{{ $id }}">{{__($product->name)}}</option>
                                                        @endforeach
                                                        </select>
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
                                        <div class="col-md-6 text-center">
                                            <p class="card-text">
                                                Order Fulfilled by DustAndThings.com
                                            </p>
                                            <img width="50%" src="{{ asset('images/dustandthings.png') }}" alt="">
                                        </div>
                                        <div class="col-md-6 text-center">
                                            Trustpilot
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