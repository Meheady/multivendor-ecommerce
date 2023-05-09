<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function stripeOrder(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51N5NxgALaLb7eSwmWThdSPeWOHs5zD7bwnwn3YJoMc3RUcPYkH0XXjzMGE3teiZpLFMlkrvZB9lSI2PDVFYwGh8700EflEvKwB');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => 999,
            'currency' => 'usd',
            'description' => 'Online Market ',
            'source' => $token,
            'metadata' => ['order_id' => '6735'],
        ]);
    }
}
