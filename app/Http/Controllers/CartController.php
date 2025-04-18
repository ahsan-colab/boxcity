<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Controller responsible for handling shopping cart operations.
 */
class CartController extends Controller
{
    protected CartService $cartService;

    /**
     * Inject the CartService dependency.
     *
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the current contents of the shopping cart.
     *
     * Retrieves the cart data from the session using CartService.
     * If no cart exists, an empty array is returned instead.
     *
     * @return View
     */
    public function index(): View
    {
        $cart = $this->cartService->getCart();
        return view('web.order.cart', compact('cart'));
    }

    /**
     * Store or update the shopping cart data in the session.
     *
     * This method expects a 'cart' key in the request data,
     * which will replace the current session cart.
     *
     * @param Request $request The incoming HTTP request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->cartService->store($request->input('cart'));
        return response()->json([
            'message' => 'Cart updated successfully!',
        ]);
    }

    /**
     * Clear the shopping cart data from the session.
     *
     * Removes the 'cart' key from the session entirely.
     *
     * @return JsonResponse
     */
    public function clear(): JsonResponse
    {
        $this->cartService->clear();
        return response()->json([
            'message' => 'Cart cleared!',
        ]);
    }
}
