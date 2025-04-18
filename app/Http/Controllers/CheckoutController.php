<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Services\CartService;
use App\Services\EcwidApiClient;
use App\Services\OrderBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Controller responsible for managing the checkout process.
 */
class CheckoutController extends Controller
{
    protected CartService $cartService;
    protected EcwidApiClient $ecwidClient;
    protected OrderBuilder $orderBuilder;

    /**
     * Inject dependencies via constructor.
     *
     * @param CartService $cartService
     * @param EcwidApiClient $ecwidClient
     * @param OrderBuilder $orderBuilder
     */
    public function __construct(
        CartService $cartService,
        EcwidApiClient $ecwidClient,
        OrderBuilder $orderBuilder
    ) {
        $this->cartService = $cartService;
        $this->ecwidClient = $ecwidClient;
        $this->orderBuilder = $orderBuilder;
    }

    /**
     * Display the checkout view.
     *
     * @return View
     */
    public function index(): View
    {
        return view('web.order.checkout');
    }

    /**
     * Process the checkout and place the order via Ecwid API.
     *
     * @param CheckoutRequest $request
     * @return JsonResponse
     *
     * @throws GuzzleException
     */
    public function processCheckout(CheckoutRequest $request): JsonResponse
    {
        $cart = $this->cartService->getCart();

        if ($this->cartService->isEmpty()) {
            return response()->json(['error' => 'Your cart is empty.'], 400);
        }

        $orderData = $this->orderBuilder->build($request, $cart);

        $response = $this->ecwidClient->postOrder($orderData);

        if (isset($response['error'])) {
            // Log the error for debugging
            Log::error('Order placement failed', [
                'error' => $response['error'],
                'orderData' => $orderData,
                'response' => $response['details'] ?? 'No further details available.',
            ]);

            return response()->json([
                'error' => $response['error'],
                'response' => $response['details'] ?? 'No further details available.',
            ], 400);
        }

        $this->cartService->clear();

        return response()->json([
            'success' => 'Order has been placed successfully!',
            'orderId' => $response['id'],
        ]);
    }

    /**
     * Display the thank you page after successful checkout.
     *
     * @return View
     */
    public function thankyou(): View
    {
        return view('web.order.thankyou');
    }

}
