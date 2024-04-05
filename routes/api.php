<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(PaymentController::class)->group(function () {
    Route::post('pay', 'payment')->name('pay');
    Route::get('success_pay', 'payment_callback')->name('success_pay');
    // Route::get('error_pay', 'error_payment')->name('error_pay');
});
