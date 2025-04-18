<?php

namespace App\Services;

use Illuminate\Http\Request;

class OrderBuilder
{
    /**
     * Build the Ecwid-compatible order data array.
     *
     * @param Request $request
     * @param array $cart
     * @return array
     */
    public function build(Request $request, array $cart): array
    {
        return [
            'email' => $request->email,
            'phone' => $request->phone,
            'billingPerson' => [
                'name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'street' => $request->address,
            ],
            'items' => array_map(function ($item) {
                return [
                    'productId' => $item['productId'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
            }, $cart),
            'paymentMethod' => 'COD',
            'shippingOption' => [
                'shippingCarrierName' => 'Standard Shipping',
                'shippingMethodName' => 'Regular',
            ],
            'orderComments' => 'Order placed via Laravel backend',
        ];
    }
}
