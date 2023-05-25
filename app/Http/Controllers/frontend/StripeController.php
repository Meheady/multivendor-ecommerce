<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\OrderCompleteNotification;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{

    public function stripeOrder(Request $request)
    {
        $user = User::where('role','admin')->get();
        if(Session::has('coupon')){
            $totalAmount = Session::get('coupon')['total_amount'];
        }
        else{
            $totalAmount = round(Cart::total());
        }
        \Stripe\Stripe::setApiKey('sk_test_51N5NxgALaLb7eSwmWThdSPeWOHs5zD7bwnwn3YJoMc3RUcPYkH0XXjzMGE3teiZpLFMlkrvZB9lSI2PDVFYwGh8700EflEvKwB');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $totalAmount,
            'currency' => 'usd',
            'description' => 'Online Market ',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        $orderId = Order::insertGetId([
            'user_id'=>Auth::id(),
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'postcode'=> $request->postcode,
            'division_id'=> $request->division,
            'district_id'=> $request->district,
            'state_id'=> $request->state,
            'address'=> $request->address,
            'note'=> $request->notes,


            'payment_type'=> $charge->payment_method,
            'payment_method'=> 'stripe',
            'txn_id'=> $charge->balance_transaction,
            'currency'=> $charge->currency,
            'amount'=> $totalAmount,
            'order_number'=> $charge->metadata->order_id,
            'invoice_no'=> 'OM'.mt_rand(10000000,99999999),
            'order_date'=> Carbon::now()->format('d F Y'),
            'order_month'=> Carbon::now()->format('F'),
            'order_year'=> Carbon::now()->format('Y'),

//            'confirm_date'=> $request->notes,
//            'processing_date'=> $request->notes,
//            'picked_date'=> $request->notes,
//            'shipped_date'=> $request->notes,
//            'delivered_date'=> $request->notes,
//            'cancel_date'=> $request->notes,
//            'return_reason'=> $request->notes,
            'status'=> 'pending',
        ]);

        $invoice = Order::findOrFail($orderId);
        $data = [
            'invoice_no'=> $invoice->invoice_no,
            'amount'=> $totalAmount,
            'name'=> $invoice->name,
            'email'=> $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content();
        foreach ($carts as $cart){
            OrderItem::insert([
               'order_id'=>$orderId,
               'product_id'=>$cart->id,
               'vendor_id'=>$cart->options->vendor_id,
               'color'=>$cart->options->color,
               'size'=>$cart->options->size,
               'qty'=>$cart->qty,
               'price'=>$cart->price,
            ]);
        }

        if (Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();

        Notification::send($user, new OrderCompleteNotification($request->name));
        return redirect()->route('dashboard')->with('message','Your order place successfully');
    }

    public function cashOrder(Request $request)
    {
        $user = User::where('role','admin')->get();
        if(Session::has('coupon')){
            $totalAmount = Session::get('coupon')['total_amount'];
        }
        else{
            $totalAmount = round(Cart::total());
        }

        $orderId = Order::insertGetId([
            'user_id'=>Auth::id(),
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'postcode'=> $request->postcode,
            'division_id'=> $request->division,
            'district_id'=> $request->district,
            'state_id'=> $request->state,
            'address'=> $request->address,
            'note'=> $request->notes,

            'payment_type'=> 'Cash on delivery',
            'payment_method'=> 'Cash on delivery',
            'currency'=> 'usd',
            'amount'=> $totalAmount,

            'invoice_no'=> 'OM'.mt_rand(10000000,99999999),
            'order_date'=> Carbon::now()->format('d F Y'),
            'order_month'=> Carbon::now()->format('F'),
            'order_year'=> Carbon::now()->format('Y'),

//            'confirm_date'=> $request->notes,
//            'processing_date'=> $request->notes,
//            'picked_date'=> $request->notes,
//            'shipped_date'=> $request->notes,
//            'delivered_date'=> $request->notes,
//            'cancel_date'=> $request->notes,
//            'return_reason'=> $request->notes,
            'status'=> 'pending',
        ]);


        $invoice = Order::findOrFail($orderId);
        $data = [
            'invoice_no'=> $invoice->invoice_no,
            'amount'=> $totalAmount,
            'name'=> $invoice->name,
            'email'=> $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));


        $carts = Cart::content();
        foreach ($carts as $cart){
            OrderItem::insert([
               'order_id'=>$orderId,
               'product_id'=>$cart->id,
               'vendor_id'=>$cart->options->vendor_id,
               'color'=>$cart->options->color,
               'size'=>$cart->options->size,
               'qty'=>$cart->qty,
               'price'=>$cart->price,
            ]);
        }

        if (Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();
        Notification::send($user, new OrderCompleteNotification($request->name));
        return redirect()->route('dashboard')->with('message','Your order place successfully');
    }
}
