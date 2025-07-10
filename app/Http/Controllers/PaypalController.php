<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPalService;
use App\Http\Requests\CheckoutRequest;

class PayPalController extends Controller
{

    public function createOrder(Request $request, PayPalService $paypal)
    {
        $amount = $request->input('amount', 0);

        if ($amount <= 0) {
            return response()->json(['error' => 'Invalid amount.'], 422);
        }

        $order = $paypal->createOrder($amount);

        $approveUrl = collect($order['links'])->firstWhere('rel', 'approve')['href'] ?? null;

        return response()->json([
            'paypal_url' => $approveUrl,
            'orderID' => $order['id']
        ]);
    }




    // 🔹 Capture the order after approval
    public function captureOrder(Request $request, PayPalService $paypal)
    {
        $orderId = $request->query('token');

        try {
            $response = $paypal->captureOrder($orderId);

            // Payment successful → now place order
            $checkoutRequest = new CheckoutRequest($request->all()); // Be sure this includes all required fields
            $checkoutController = app()->make(\App\Http\Controllers\CheckoutController::class);
            return $checkoutController->processCheckout($checkoutRequest);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'PayPal capture failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

