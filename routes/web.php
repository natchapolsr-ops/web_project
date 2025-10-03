<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // จ่ายเงิน
    Route::get('/create-promptpay-charge', [PaymentController::class, 'createPromptpayCharge'])
        ->name('payment.promptpay');

    // เช็กสถานะ
    Route::get('/payment-status/{id}', [PaymentController::class, 'checkStatus'])
        ->name('payment.status');
});

Route::post('/omise/webhook', [PaymentController::class, 'handleWebhook']);
