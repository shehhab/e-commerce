<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Authentication\ValidOTPController;
use App\Http\Controllers\Authentication\VerifyEmailController;
use App\Http\Controllers\Authentication\DeleteAccountController;
use App\Http\Controllers\Authentication\ResendOTPCodeController;
use App\Http\Controllers\Authentication\ResetPasswordController;
use App\Http\Controllers\Authentication\ChangePasswordController;
use App\Http\Controllers\Authentication\ForgetPasswordController;
use App\Http\Controllers\Product\AllProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1/user'], function () {
    Route::post('/auth/register', RegisterController::class);
    Route::post('/auth/login', LoginController::class);
    Route::post('/auth/forget_password', ForgetPasswordController::class);
    Route::post('/auth/resend_otp', ResendOTPCodeController::class);
    Route::post('/auth/reset_password', ResetPasswordController::class);
    Route::post('/auth/check_otp', ValidOTPController::class);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::post('/auth/verify_email', VerifyEmailController::class);
        Route::post('/auth/change_password', ChangePasswordController::class);
        Route::post('/auth/delete_account', DeleteAccountController::class);
        Route::post('/auth/logout', LogoutController::class);

    });
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/product/All_Product', AllProductController::class);

    
    Route::group(['middleware' => 'auth:sanctum'], function () {


    });
});
