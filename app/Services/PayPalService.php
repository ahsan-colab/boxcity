<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use PayPal\Checkout\Orders\OrdersCreateRequest;
use PayPal\Checkout\Orders\OrdersCaptureRequest;
use PayPal\Checkout\Core\PayPalHttpClient;
use PayPal\Checkout\Core\SandboxEnvironment;

class PayPalService
{
    protected $clientId;
    protected $secret;
    protected $baseUrl;
    protected $accessToken;

    public function __construct()
    {
        $this->clientId = config('paypal.client_id');
        $this->secret   = config('paypal.secret');
        $this->baseUrl = config('paypal.mode') === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
        $this->accessToken = $this->generateAccessToken();
    }

    protected function generateAccessToken()
    {
        $response = Http::withBasicAuth($this->clientId, $this->secret)
            ->asForm()
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials'
            ]);

        if (!$response->successful()) {
            throw new \Exception("Failed to generate PayPal access token.");
        }

        return $response->json()['access_token'];
    }

    public function createOrder($amount)
    {
        $response = Http::withToken($this->accessToken)
            ->post("{$this->baseUrl}/v2/checkout/orders", [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($amount, 2, '.', ''),
                    ]
                ]],
                'application_context' => [
                    'return_url' => route('paypal.success'),
                    'cancel_url' => route('paypal.cancel'),
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception("Failed to create PayPal order.");
        }

        return $response->json();
    }

    public function captureOrder(string $orderId)
    {
        $response = Http::withToken($this->accessToken)
            ->post("{$this->baseUrl}/v2/checkout/orders/{$orderId}/capture");

        if (!$response->successful()) {
            \Log::error('❌ PayPal capture failed', [
                'status' => $response->status(),
                'order_id' => $orderId,
                'response_body' => $response->body()
            ]);

            throw new \Exception("Failed to capture PayPal order.");
        }

        return $response->json();
    }



}
