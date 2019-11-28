<?php

namespace App\Integrations;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
class Mailchimp {

    private $client;

    public function __construct()
    {
        $this->client = app(Client::class);
    }

    public function getLists(string $url, string $accessToken)
    {
        $response = $this->client->request('GET', $url . '/lists', [
            'headers' => [
                'Authorization' => 'OAuth ' . $accessToken,
                'Accept' => 'application/json'
            ]
        ]);
        if($response->getStatusCode() == 200) {
            return json_decode($response->getBody());
        }
        throw new Exception("Could not get lists from mailchimp");
    }
}