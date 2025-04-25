<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;

Route::middleware('auth:keycloak')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user(); 
    });

    Route::apiResource('subscribers', SubscriberController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
});
