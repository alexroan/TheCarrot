<?php

namespace App\External;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MailchimpApi {

    private $client;

    public function __construct()
    {
        $this->client = app(Client::class);
    }

    public function getLists($accessToken, $baseUrl)
    {
        $url = $baseUrl . '/lists';
        return $this->get($accessToken, $url);
    }

    /**
     * Get function
     *
     * @param string $accessToken
     * @param string $url
     * @return void
     */
    private function get($accessToken, $url)
    {
        $response = $this->request('GET', $accessToken, $url);
        $code = $response->getStatusCode();
        $body = $response->getBody();
        if ($code == 200) {
            return json_decode($body);
        }
        throw new Exception("Mailchimp API error. Code: $code, body: $body");
    }

    /**
     * Make request
     *
     * @param string $method
     * @param string $accessToken
     * @param string $url
     * @return Psr\Http\Message\ResponseInterface response
     */
    private function request($method, $accessToken, $url)
    {
        $headers = [
            'Authorization'     => 'OAuth ' . $accessToken
        ];

        $options = [
            'headers' => $headers
        ];
        $response = $this->client->request($method, $url, $options);
        return $response;
    }
}