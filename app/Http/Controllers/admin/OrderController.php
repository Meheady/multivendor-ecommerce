<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pendingOrder()
    {
        $allData = Order::where('status','pending')->orderBy('id','desc')->get();

        return view('admin.order.pending',compact('allData'));
    }
    public function confirmOrder()
    {
        $allData = Order::where('status','confirm')->orderBy('id','desc')->get();

        return view('admin.order.confirm',compact('allData'));
    }
    public function processingOrder()
    {
        $allData = Order::where('status','processing')->orderBy('id','desc')->get();

        return view('admin.order.processing',compact('allData'));
    }
    public function deliveredOrder()
    {
        $allData = Order::where('status','delivered')->orderBy('id','desc')->get();

        return view('admin.order.delivered',compact('allData'));
    }
    public function orderDetails($id)
    {
        $order = Order::with('division','district','state','user')->where('id',$id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->get();

        return view('admin.order.details',compact('order','orderItems'));
    }
}
