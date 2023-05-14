<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function returnRequest()
    {
        $allData = Order::where('return_order','=','1')->orderBy('id','desc')->get();

        return view('admin.order.return-request',compact('allData'));
    }
    public function confirmReturn()
    {
        $allData = Order::where('return_order','=','2')->orderBy('id','desc')->get();

        return view('admin.order.return-confirm',compact('allData'));
    }
    public function approveReturn($id)
    {
        $allData = Order::where('id',$id)->update(['return_order' => 2]);

        return redirect()->back()->with('success','Return approve  successfully');
    }
}
