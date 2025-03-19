<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Show Cart Page
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('layouts.cart', compact('cart'));
    }

    // Store Cart Data in Session
    public function store(Request $request)
    {
        Session::put('cart', $request->cart);
        return response()->json(['message' => 'Cart updated successfully!']);
    }

    // Clear Cart
    public function clear()
    {
        Session::forget('cart');
        return response()->json(['message' => 'Cart cleared!']);
    }
}

