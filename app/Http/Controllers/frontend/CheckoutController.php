<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
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

        $cartTotal = Cart::total();

        if ($request->payment_option == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }
        else if ($request->payment_option == 'card'){
            return view('frontend.payment.card',compact('data','cartTotal'));
        }
        else {
            return view('frontend.payment.cash',compact('data','cartTotal'));
        }

    }

}
