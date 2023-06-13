<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use App\Models\User;
use App\Notifications\OrderCompleteNotification;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public $cusData;

    public function getDistrict($id)
    {
        $districts = ShipDistrict::where('division_id',$id)->get();
        return response()->json($districts);

    }

    public function getState($id)
    {
        $states = ShipState::where('district_id',$id)->get();
        return response()->json($states);

    }
    public function checkoutStore(Request $request)
    {
        $data = [];
        $data['name'] = $request->username;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['postcode'] = $request->postcode;
        $data['division'] = $request->division;
        $data['district'] = $request->district;
        $data['state'] = $request->state;
        $data['address'] = $request->address;
        $data['notes'] = $request->notes;

        $this->cusData = $data;

        $cartTotal = Cart::total();

        if ($request->payment_option == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }
        else if ($request->payment_option == 'aamarpay'){
            if(Session::has('coupon')){
                $totalAmount = Session::get('coupon')['total_amount'];
            }
            else{
                $totalAmount = round(Cart::total());
            }
            $url = 'https://sandbox.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
            $fields = array(
                'store_id' => 'aamarpaytest', //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                'amount' => $totalAmount, //transaction amount
                'payment_type' => 'VISA', //no need to change
                'currency' => 'BDT',  //currenct will be USD/BDT
                'tran_id' => rand(1111111,9999999), //transaction id must be unique from your end
                'cus_name' => $data['name'],  //customer name
                'cus_email' => $data['email'], //customer email address
                'cus_add1' => $data['address'],  //customer address
                'cus_add2' => $data['division'], //customer address
                'cus_city' => $data['district'],  //customer city
                'cus_state' => $data['state'],  //state
                'cus_postcode' => $data['postcode'], //postcode or zipcode
                'cus_country' => 'Bangladesh',  //country
                'cus_phone' => $data['phone'], //customer phone number
                'cus_fax' => 'Not¬Applicable',  //fax
                'ship_name' => 'ship name', //ship name
                'ship_add1' => 'House B-121, Road 21',  //ship address
                'ship_add2' => 'Mohakhali',
                'ship_city' => $data['district'],
                'ship_state' => $data['state'],
                'ship_postcode' => $data['postcode'],
                'ship_country' => 'Bangladesh',
                'desc' => $data['notes'],
                'success_url' => route('success'), //your success route
                'fail_url' => route('fail'), //your fail route
                'cancel_url' => route('cancel'), //your cancel url
                'opt_a' => Auth::id(),  //optional paramter
                'opt_b' => $data['division'],
                'opt_c' => $data['district'],
                'opt_d' => $data['state'],
                'signature_key' => 'dbb74894e82415a2f7ff0ec3a97e4183'); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

            $fields_string = http_build_query($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
            curl_close($ch);

            $this->redirect_to_merchant($url_forward);
        }
        else {
            return view('frontend.payment.cash',compact('data','cartTotal'));
        }
    }

    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head><script type="text/javascript">
                function closethisasap() { document.forms["redirectpost"].submit(); }
            </script></head>
        <body onLoad="closethisasap();">

        <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
        <!-- for live url https://secure.aamarpay.com -->
        </body>
        </html>
        <?php
        exit;
    }


    public function success(Request $request){

        $user = User::where('role','admin')->get();

        $orderId = Order::insertGetId([
            'user_id'=> $request->opt_a,
            'name'=> $request->cus_name,
            'email'=> $request->cus_email,
            'phone'=> $request->cus_phone,
            'postcode'=> '1212',
            'division_id'=> $request->opt_b,
            'district_id'=> $request->opt_c,
            'state_id'=> $request->opt_d,
            'address'=> 'n/a',
            'note'=> 'n/a',


            'payment_type'=> $request->payment_type,
            'payment_method'=>  $request->card_type,
            'txn_id'=> $request->bank_txn,
            'currency'=> $request->currency,
            'amount'=> $request->amount,
            'order_number'=> uniqid(),
            'invoice_no'=> 'OM'.mt_rand(10000000,99999999),
            'order_date'=> Carbon::now()->format('d F Y'),
            'order_month'=> Carbon::now()->format('F'),
            'order_year'=> Carbon::now()->format('Y'),
            'status'=> 'pending',
        ]);

        $invoice = Order::findOrFail($orderId);
        $data = [
            'invoice_no'=> $invoice->invoice_no,
            'amount'=> $request->amount,
            'name'=> $invoice->name,
            'email'=> $invoice->email,
        ];

        Mail::to($request->cus_email)->send(new OrderMail($data));

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
        return redirect()->route('user.order')->with('message','Your order place successfully');
    }

    public function fail(Request $request){
        return $request;
    }
    public function cancel(){
    return redirect()->url('/');
    }

}
