<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // ECWID API Endpoint and Authentication
        $ecwidApiUrl = 'https://app.ecwid.com/api/v3/109333282/products?category=174051814&offset=1';
        $accessToken = env('ECWID_SECRET_KEY');

        // Initialize the Guzzle client
        $client = new Client();

        try {
            // Send GET request to ECWID API
            $response = $client->request('GET', $ecwidApiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept' => 'application/json',
                ]
            ]);

            // Get the response body and decode JSON
            $data = json_decode($response->getBody()->getContents(), true);

            // Return the data to the view
            return view('home', ['orders' => $data]);

        } catch (\Exception $e) {
            // Handle any errors (e.g., API not reachable)
            return view('home', ['error' => 'Error fetching data: ' . $e->getMessage()]);
        }
    }
}
