<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AllUserController extends Controller
{
    public function userAccount()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.user.account-details', compact('user'));
    }
    public function changePassword()
    {
        return view('frontend.user.change-password');
    }
    public function userOrder()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id','desc')->get();
        return view('frontend.user.orders',compact('orders'));
    }
    public function userOrderDetails($id)
    {
        $uid = Auth::user()->id;
        $order = Order::with('division','district','state','user')->where('id',$id)->where('user_id', $uid)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->get();

        return view('frontend.user.order-details',compact('order','orderItems'));
    }
    public function invoiceDownload($id)
    {
        $uid = Auth::user()->id;
        $order = Order::with('division','district','state','user')->where('id',$id)->where('user_id', $uid)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->get();

        $pdf = Pdf::loadView('frontend.user.invoice',compact('order','orderItems'))
            ->setPaper('a4' )->setOption([
                'tempDir'=> public_path(),
                'chroot'=> public_path(),
            ]);
        return $pdf->download('invoice.pdf');
    }
}
