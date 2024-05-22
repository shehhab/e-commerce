<?php

namespace App\Http\Controllers\Payment;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\PaymentInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentInformationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'card_number' => 'required|string',
            'cvc' => 'required|string',
            'expiry' => 'required|string',
            'email' => 'required|email',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user already has payment information
        $paymentInfo = PaymentInformation::where('user_id', $user->id)->first();

        if ($paymentInfo) {
            // If payment information exists, update it
            $paymentInfo->update([
                'card_number' => $validatedData['card_number'],
                'cvc' => $validatedData['cvc'],
                'expiry' => $validatedData['expiry'],
                'email' => $validatedData['email'],
            ]);
        } else {
            // If payment information doesn't exist, create a new entry
            $paymentInfo = PaymentInformation::create([
                'user_id' => $user->id,
                'card_number' => $validatedData['card_number'],
                'cvc' => $validatedData['cvc'],
                'expiry' => $validatedData['expiry'],
                'email' => $validatedData['email'],
            ]);
        }

        // Delete all cart items associated with the user
        Cart::where('user_id', $user->id)->delete();

        // Return a response
        return $this->handleResponse(message: 'Payment information stored successfully' , code :200);
    }
}
