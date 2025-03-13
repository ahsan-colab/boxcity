<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $ecwidApiUrl = 'https://app.ecwid.com/api/v3/109333282/products';
        $accessToken = env('ECWID_SECRET_KEY');
        $client = new Client();

        $limit = 30;
        $offset = $request->input('offset', 0);
        $filteredProducts = [];

        try {
            while (count($filteredProducts) < $limit) {
                $response = $client->request('GET', $ecwidApiUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Accept' => 'application/json',
                    ],
                    'query' => [
                        'category' => 174055330,
                        'limit' => $limit + 400,
                        'offset' => $offset,
                    ],
                ]);

                $data = json_decode($response->getBody()->getContents(), true);
//                dd($data);
                if (isset($data['items'])) {
                    foreach ($data['items'] as $product) {
                        if (isset($product['quantity']) && $product['quantity'] > 0) {
                            $filteredProducts[] = $product;
                        }
                        if (count($filteredProducts) >= $limit) {
                            break; // Stop when we have 30 valid products
                        }
                    }
                }

                // Increase offset for next batch if needed
                $offset += $limit + 10;

                // If no more products exist, break loop
                if (count($data['items']) < ($limit + 10)) {
                    break;
                }
            }

            $hasMore = count($filteredProducts) === $limit;

            if ($request->ajax()) {
                return response()->json([
                    'products' => array_values($filteredProducts),
                    'hasMore' => $hasMore,
                    'newOffset' => $offset,
                ]);
            }

            return view('home', ['products' => $filteredProducts]);

        } catch (\Exception $e) {
            return view('home', ['error' => 'Error fetching data: ' . $e->getMessage()]);
        }
    }
}
