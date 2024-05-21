<?php

namespace App\Http\Controllers\Authentication;

use Exception;
use Ichtrojan\Otp\Otp;
use App\Traits\ResponseTrait;
use App\Emails\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Resources\Authentication\LoginResources;

class LoginController extends Controller
{
    use ResponseTrait;
    public function __invoke(LoginRequest $request , Exception $e)
    {

        $validatedData = $request->validated();

        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {

            $user = Auth::user();
            // to retuen message to send many requests login email
            if (RateLimiter::tooManyAttempts('send-message:'.auth()->user(), $perMinute = 3)) {
                $seconds = RateLimiter::availableIn('send-message:'.auth()->user());


                return $this->handleResponse(status:false,message:'too Many Attempts , You may try again in '.$seconds.' seconds.' , code:429);


            }

            RateLimiter::hit('send-message:'.auth()->user());



            return $this->handleResponse(status:true,message:'Welcome Back '. $user->name , data: new LoginResources($user));
        }
        // to retuen message to send many requests when wrong password

        if (RateLimiter::tooManyAttempts('send-message:'.auth()->user(), $perMinute = 3)) {
            $seconds = RateLimiter::availableIn('send-message:'.auth()->user());


            return $this->handleResponse(status:false,message:'too Many Attempts , You may try again in '.$seconds.'seconds.' , code:429);


        }

        RateLimiter::hit('send-message:'.auth()->user());


        return $this->handleResponse( code:401 ,status: false, message: 'Wrong Email Or Password!');



    }
}
