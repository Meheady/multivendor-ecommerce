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
    public function vendorOrderDetails($id)
    {
        $order = Order::with('division','district','state','user')->where('id',$id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->get();

        return view('vendor.order.details',compact('order','orderItems'));
    }
    public function vendorReturnOrder()
    {
        $allData = OrderItem::where('vendor_id', Auth::user()->id)
            ->with('order')
            ->orderBy('id', 'desc')
            ->get();
        return view('vendor.order.return',compact('allData'));
    }
    public function vendorConfirmReturnOrder()
    {
        $allData = OrderItem::where('vendor_id', Auth::user()->id)
            ->with('order')
            ->orderBy('id', 'desc')
            ->get();
        return view('vendor.order.return-confirm',compact('allData'));
    }
}
