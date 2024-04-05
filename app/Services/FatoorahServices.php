<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class FatoorahServices
{
    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $requrst_client)
    {
        $this->request_client = $requrst_client;
        $this->base_url = env("FATOORAH_BASE_URL");
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer " . env('FATOORAH_TOKEN'),
        ];
    }

    private function buildRequest($url, $method, $data = [])
    {
        $request = new Request($method, $this->base_url . $url, $this->headers);

        if (!$data) return false;

        $response = $this->request_client->send($request, [
            'json' => $data
        ]);

        if ($response->getStatusCode() != 200) return false;
        return json_decode($response->getBody(), true);
    }

    public function sendPayment($data)
    {
        $response = $this->buildRequest('v2/SendPayment', 'POST', $data);
        return $response;
    }

    public function getPaymentStatus($data)
    {
        return $this->buildRequest('v2/getPaymentStatus', 'POST', $data);
    }
}
