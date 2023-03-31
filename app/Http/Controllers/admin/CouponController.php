<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function allCoupon()
    {
        $allData = Coupon::all();
        return view('admin.coupon.all-coupon',compact('allData'));
    }
    public function createCoupon()
    {
        return view('admin.coupon.create-coupon');
    }


    public function storeCoupon(Request $request)
    {

        $request->validate([
           'coupon_name'=>'required',
           'coupon_discount'=>'required'
        ]);

        Coupon::insert([
           'coupon_name'=>strtoupper($request->coupon_name),
           'coupon_discount'=>$request->coupon_discount,
           'coupon_validity'=>$request->coupon_validity,
           'status'=>$request->status,
        ]);
        return redirect()->back()->with('success','Coupon save successfully');
    }

    public function editCoupon($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit-coupon',compact('coupon'));
    }
     public function updateCoupon(Request $request, $id)
    {
        $coupon = Coupon::find($id)->update([
            'coupon_name'=>strtoupper($request->coupon_name),
            'coupon_discount'=>$request->coupon_discount,
            'coupon_validity'=>$request->coupon_validity,
            'status'=>$request->status,
        ]);
        return redirect()->route('all-coupon')->with('success','Coupon update successfully');
    }
    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id)->delete();
        return redirect()->back()->with('success','Coupon delete successfully');
    }
}
