<?php

namespace App\External;

use GuzzleHttp\Client;

class GoogleFontsApi
{
    private $client;
    private $url;

    public function __construct()
    {
        $this->client = app(Client::class);
        $key = config('app.google.fonts.key');
        $this->url = "https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=$key";
    }

    public function getFonts()
    {
        $rawResponse = $this->client->request('GET', $this->url);
        $code = $rawResponse->getStatusCode();
        if($code == 200) {
            return \json_decode($rawResponse->getBody());
        }
        return false;
    }
}