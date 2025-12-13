<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Exttransfer;
use App\Models\User;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\VirtualController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('payment', [ApiController::class, 'payment']);
Route::get('verify-payment/{tx_ref}', [ApiController::class, 'verifyPayment']);
Route::post('popup-submit/{id}', [ApiController::class, 'popupSubmit']);
Route::post('pin-submit/{id}', [ApiController::class, 'PinSubmit']);
Route::post('avs-submit/{id}', [ApiController::class, 'AvsSubmit']);
Route::post('otp-submit/{id}', [ApiController::class, 'OtpSubmit']);
Route::get('webhook-card/{id}', [ApiController::class, 'webhookCard']);
Route::get('country', [ApiController::class, 'getCountry']);
Route::get('state/{id}', [ApiController::class, 'getState']);
Route::post('popup_transfer', [ApiController::class, 'popupPay']);
Route::get('currency_supported', [ApiController::class, 'supportedCountries']);
