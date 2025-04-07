<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index()
    {
        $cart = Session::get('cart', []);
        return view('layouts.cart', compact('cart'));
    }


    public function store(Request $request)
    {
        Session::put('cart', $request->cart);
        return response()->json(['message' => 'Cart updated successfully!']);
    }


    public function clear()
    {
        Session::forget('cart');
        return response()->json(['message' => 'Cart cleared!']);
    }
}

