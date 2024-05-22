<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowAllCartController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get all items in the user's cart
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Return the cart items as a response
        return response()->json($cartItems);
    }

}
