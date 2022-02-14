<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $cartService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function store(StoreCartRequest $request)
    {
        try {
            $cart = $this->cartService->storeCart($request);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred...',
                'error' => $exception->getMessage()
            ], 500);
        }

        if (gettype($cart) == 'boolean') {
            return response()->json([
                'message' => 'Add to cart successfully!',
            ], 201);
        }

        return response()->json([
            'error' => 'Unable to add to the following to cart...',
            'message' => 'Reduce the quantity and try again.',
            'data' => $cart
        ], 500);
    }
}
