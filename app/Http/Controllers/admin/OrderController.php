<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function changeOrderStatus($id)
    {
        $order = Order::findOrFail($id);

        if($order->status == 'pending'){
            $order->status = 'confirm';
            $order->save();
            return redirect()->route('pending.order')->with('success','Order confirm successfully');
        }
        elseif($order->status == 'confirm'){
            $order->status = 'processing';
            $order->save();
            return redirect()->route('confirm.order')->with('success','Order processing successfully');
        }elseif($order->status == 'processing'){
            $product = OrderItem::where('order_id',$id)->get();
            foreach ($product as $item){
                Product::where('id',$item->product_id)->update(['product_qty'=>DB::raw('product_qty-'.$item->qty)]);
            }
            $order->status = 'delivered';
            $order->save();
            return redirect()->route('processing.order')->with('success','Order delivered successfully');
        }
    }

    public function invoiceDownload($id)
    {
        $order = Order::with('division','district','state','user')->where('id',$id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->get();

        $pdf = Pdf::loadView('admin.order.invoice',compact('order','orderItems'))
            ->setPaper('a4' )->setOption([
                'tempDir'=> public_path(),
                'chroot'=> public_path(),
            ]);
        return $pdf->download($order->invoice_no.'.pdf');
    }
}
