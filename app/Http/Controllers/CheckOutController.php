<?php

namespace App\Http\Controllers;

use App\Services\EcwidApiClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('layouts.checkout');
    }

    /**
     * @throws GuzzleException
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return response()->json(['error' => 'Your cart is empty.'], 400);
        }

        $orderData = [
            "email" => $request->email,
            "phone" => $request->phone,
            "billingPerson" => [
                "name" => $request->full_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "street" => $request->address,
            ],
            "items" => array_map(function ($item) {
                return [
                    "productId" => $item['productId'],
                    "quantity" => $item['quantity'],
                    "price" => $item['price']
                ];
            }, $cart),
            "paymentMethod" => "COD",
            "shippingOption" => [
                "shippingCarrierName" => "Standard Shipping",
                "shippingMethodName" => "Regular"
            ],
            "orderComments" => "Order placed via Laravel backend"
        ];

        $ecwidClient = new EcwidApiClient();
        $response = $ecwidClient->postOrder($orderData);

        if ($response->successful()) {
            Session::forget('cart');
            return response()->json(['success' => 'Order placed successfully!', 'orderId' => $response->json()['id']]);
        } else {
            return response()->json(['error' => 'Failed to place order.', 'details' => $response->body()], 400);
        }
    }

    public function thankyou()
    {
        return view('layouts.orderthankyou');
    }

}



