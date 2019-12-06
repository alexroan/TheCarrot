<?php

namespace App\External;

use Exception;
use GuzzleHttp\Client;

class MailchimpApi {

    private $client;

    /**
     * Create new mailchimp api
     */
    public function __construct()
    {
        $this->client = app(Client::class);
    }

    /**
     * Get all mailing lists
     *
     * @param string $accessToken
     * @param string $baseUrl
     * @return mixed response
     */
    public function getLists($accessToken, $baseUrl)
    {
        $url = $baseUrl . '/lists';
        return $this->get($accessToken, $url);
    }

    /**
     * Get Merge fields for list id
     *
     * @param string $accessToken
     * @param string $baseUrl
     * @param string $listId
     * @return void
     */
    public function getMergeFields($accessToken, $baseUrl, $listId)
    {
        $url = $baseUrl . '/lists/' . $listId . '/merge-fields';
        return $this->get($accessToken, $url);
    }

    /**
     * Subscribe to a mailing list
     *
     * @param string $accessToken
     * @param string $baseUrl
     * @param string $listId
     * @return mixed response
     */
    public function subscribe($accessToken, $baseUrl, $listId, $email)
    {
        $url = $baseUrl . '/lists/' . $listId .'/members';
        $body = [
            'email_address' => $email,
            'status'        => 'subscribed'
        ];
        return $this->post($accessToken, $url, $body);
    }

    /**
     * Post function
     *
     * @param string $accessToken
     * @param string $url
     * @return mixed response
     */
    private function post($accessToken, $url, $body)
    {
        $response = null;
        try{
            $response = $this->request('POST', $accessToken, $url, $body);
        }
        catch (Exception $e) {
            throw new Exception($e->getResponse()->getBody());
        }
        $body = $response->getBody();
        return json_decode($body);
    }

    /**
     * Get function
     *
     * @param string $accessToken
     * @param string $url
     * @return mixed response
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
    private function request($method, $accessToken, $url, $body = [])
    {
        $headers = [
            'Authorization'     => 'OAuth ' . $accessToken
        ];

        $options = [
            'headers' => $headers,
            'json' => $body
        ];
        $response = $this->client->request($method, $url, $options);
        return $response;
    }
}