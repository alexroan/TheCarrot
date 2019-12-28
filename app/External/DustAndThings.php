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
        $email = array_key_exists('email_address', $parameters) ? $parameters['email_address'] : "";
        $productId = array_key_exists('product_id', $parameters) ? $parameters['product_id'] : "";
        $productText = array_key_exists('product_text', $parameters) ? $parameters['product_text'] : "";
        return $this->url . $productId
            . ":1?attributes[name-on-keyring]=" . $productText
            . "&discount=" . $discountCode
            . "&checkout[email]=" . $email;
    }
}
