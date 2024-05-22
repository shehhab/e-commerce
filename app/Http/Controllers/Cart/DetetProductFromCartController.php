<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\DeleteFormCartRequest;
use Illuminate\Support\Facades\Auth;

class DetetProductFromCartController extends Controller
{
    public function __invoke(DeleteFormCartRequest $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validated();

        $user = Auth::user();

        // Find the cart item for the authenticated user and specified product
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $validatedData['product_id'])
                        ->first();

        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();
            return $this->handleResponse(message: 'Product removed from cart successfully.');

        } else {
            // If the cart item does not exist, return an error message
            return $this->handleResponse(message: 'Product not found in cart.' , code :404);

        }
    }
}
