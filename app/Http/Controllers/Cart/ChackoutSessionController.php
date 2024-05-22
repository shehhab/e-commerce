<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChackoutSessionController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'phone_number_other' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Check if a checkout session already exists for the user
        $checkout = Checkout::where('user_id', $user->id)->first();

        // If a checkout session exists, update it; otherwise, create a new one
        if ($checkout) {
            $checkout->update([
                'phone_number_other' => $validatedData['phone_number_other'] ?? $checkout->phone_number_other,
                'city' => $validatedData['city'] ?? $checkout->city,
            ]);
        } else {
            // Create a new checkout session
            $checkout = Checkout::create([
                'user_id' => $user->id,
                'phone_number_other' => $validatedData['phone_number_other'] ?? null,
                'city' => $validatedData['city'] ?? null,
            ]);
        }

        return $this->handleResponse(message: 'Checkout session updated successfully.', code: 200);
    }
}
