<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product listing page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('web.index');
    }

    /**
     * Display the product details page.
     *
     * Retrieves product details by its ID and returns the detail view.
     *
     * @param  int  $id  Product ID
     * @return View
     */
    public function detail(int $id): View
    {
        $product = Product::where('productID', $id)->firstOrFail();

        return view('web.product.detail', ['product' => $product]);
    }

    /**
     * Load more products and return HTML content for pagination.
     *
     * This method fetches 60 products at a time, renders them as HTML, and
     * returns the HTML along with pagination data for the next page.
     *
     * @return JsonResponse
     */
    public function loadMoreProducts(): JsonResponse
    {
        try {
            $products = Product::paginate(60);

            $productHtml = view('partials.product_list', ['products' => $products])->render();

            return response()->json([
                'product_html' => $productHtml,
                'next_page_url' => $products->nextPageUrl(),
                'has_more' => $products->hasMorePages(),
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Failed to load more products', ['exception' => $e]);

            return response()->json([
                'error' => 'Failed to load more products.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
