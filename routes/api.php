<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stripe\Stripe;
use Stripe\PaymentIntent;

Route::post('/payment', function (Request $request) {

    Stripe::setApiKey(env('STRIPE_SECRET'));

    $paymentIntent = PaymentIntent::create([
        'amount' => $request->amount,
        'currency' => 'usd',
        'payment_method_types' => ['card'],
    ]);

    return response()->json([
        'clientSecret' => $paymentIntent->client_secret
    ]);
});