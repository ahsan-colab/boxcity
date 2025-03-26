<?php

namespace App\Http\Controllers;

use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
       return view('home');
    }

    public function loadMoreProducts()
    {
        $products = Product::paginate(60);

        $productHtml = view('partials.product_list', ['products' => $products])->render();

        return response()->json([
            'product_html' => $productHtml,
            'next_page_url' => $products->nextPageUrl(),
            'has_more' => $products->hasMorePages(),
        ]);
    }
}
