<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        return view('layouts.product');
    }

    public function detail($id)
    {
        return view('layouts.product', ['productId' => $id]);
    }

}
