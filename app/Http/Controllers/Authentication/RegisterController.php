<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use App\Emails\EmailVerification;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Resources\Authentication\RegisterResources;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request) {

        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'] ?? null,
            'email_verified_at'=>now() , 
            'password' => Hash::make($validatedData['password']),
            'password_confirme' => Hash::make($validatedData['password_confirme']),
        ]);


        RateLimiter::hit('send-message:'.auth()->user());

        if ($request->hasFile('image')) {
            $user->addMediaFromRequest('image')->toMediaCollection('user_profile_image');
        }

        // after register operation
        // 1- send email verification notification contains OTP

        // 2- send api response to front
        return $this->handleResponse(message:'Successfully Created Account',data:new RegisterResources($user));

    }

}
