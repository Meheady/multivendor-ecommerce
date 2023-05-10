<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function vendorOrder()
    {
        $allData = OrderItem::where('vendor_id',Auth::user()->id)->with('order')->orderBy('id','desc')->get();

        return view('vendor.order.pending',compact('allData'));
    }
}
