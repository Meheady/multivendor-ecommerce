<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingOrder()
    {
        $allData = Order::where('status','pending')->orderBy('id','desc')->get();

        return view('admin.order.pending',compact('allData'));
    }
}
