<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClearProductFromCartController extends Controller
{
    public function __invoke(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Delete all cart items for the authenticated user
        Cart::where('user_id', $user->id)->delete();


        return $this->handleResponse(message: 'All products removed from cart successfully');

    }

}
