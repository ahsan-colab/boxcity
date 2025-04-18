<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Retrieve the cart from session.
     *
     * @return array
     */
    public function getCart(): array
    {
        return Session::get('cart', []);
    }

    /**
     * Store or update the cart in the session.
     *
     * @param array $cart
     * @return void
     */
    public function store(array $cart): void
    {
        Session::put('cart', $cart);
    }

    /**
     * Check if the cart is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->getCart());
    }

    /**
     * Clear the cart from the session.
     *
     * @return void
     */
    public function clear(): void
    {
        Session::forget('cart');
    }
}
