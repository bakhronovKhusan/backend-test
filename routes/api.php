<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/payment/callback-gateway1', [PaymentController::class,'gatewayOneCallback'])->middleware(['verify.gateway.one','limit.one']);
Route::post('/payment/callback-gateway2', [PaymentController::class,'gatewayTwoCallback'])->middleware(['verify.gateway.two','limit.two']);
