<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    public function __invoke(AddToCartRequest $request){

        // Validate the incoming request data
        $validatedData = $request->validated();

        $user = Auth::user();

        // Check if the product is already in the user's cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $validatedData['product_id'])
                        ->first();

        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->count = $validatedData['count'];
            $cartItem->save();
        } else {
            // Otherwise, create a new cart item
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $validatedData['product_id'],
                'count' => $validatedData['count'],
            ]);
        }
        return $this->handleResponse(message: 'Product added to cart successfully.');

    }
}


