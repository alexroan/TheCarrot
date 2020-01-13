<?php

namespace App\External;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class DustAndThings
{
    private $url = "https://dustandthings.com/cart/";

    public function __construct()
    {
    }

    public function redirect($parameters, $discountCode)
    {
        $url = $this->constructUrl($parameters, $discountCode);
        return Redirect::to($url);
    }

    private function constructUrl($parameters, $discountCode)
    {
        $email = array_key_exists('signupcarrot-email', $parameters) ? $parameters['signupcarrot-email'] : "";
        $productId = array_key_exists('product-select', $parameters) ? $parameters['product-select'] : "";
        $productText = array_key_exists('name-on-product', $parameters) ? $parameters['name-on-product'] : "";
        return $this->url . $productId
            . ":1?attributes[name-on-keyring]=" . $productText
            . "&discount=" . $discountCode
            . "&checkout[email]=" . $email;
    }
}
