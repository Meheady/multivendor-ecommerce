<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $date = date('d-m-Y');
        $date = Order::where('order_date', $date)->sum('amount');
         $month = date('F');
        $month = Order::where('order_month', $month)->sum('amount');
         $year = date('Y');
        $year = Order::where('order_year', $year)->sum('amount');

        $order  = DB::table('orders')
            ->leftJoin('order_items','orders.id','=','order_items.order_id')
            ->leftJoin('products','products.id','=','order_items.product_id')
            ->leftJoin('users','users.id','=','orders.user_id')
            ->get();

        $pendingOrder = Order::where('status', 'pending')->get();

        $vendor = User::where('role','vendor')->where('status','active')->get();
        $customer = User::where('role','user')->where('status','active')->get();



        return view('admin.index',compact('date','month','year','order','pendingOrder','vendor','customer'));
    }

    public function adminLogin()
    {
        return view('admin.admin-login');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('admin.admin-profile',compact('userData'));
    }

    public function AdminProfileUpdate(Request $request,$id)
    {
        User::updateAdminUser($request,$id);
        return redirect()->back()->with('success','Profile Update Successfully');
    }
    public function AdminChangePassword()
    {
        return view('admin.admin-cng-password');
    }
    public function AdminChangePasswordSave(Request $request)
    {
        $request->validate([
            'oldpass'=>'required',
            'newpass'=>'required|confirmed'
        ]);
        if (!Hash::check($request->oldpass, Auth::user()->password)){
            return redirect()->back()->with('error',"Old Password Dosen't Match");
        }else{
            User::changePassword($request);
            return redirect()->back()->with('success',"Password Change Successfully");
        }

    }

    public function inactiveVendor()
    {
        $inactiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('admin.vendor.inactive-vendor',compact('inactiveVendor'));
    }
    public function activeVendor()
    {
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('admin.vendor.active-vendor',compact('activeVendor'));
    }

    public function activeVendorDetails($id)
    {
        $userData = User::find($id);
        return view('admin.vendor.active-vendor-details',compact('userData'));
    }
    public function inactiveVendorDetails($id)
    {
        $userData = User::find($id);
        return view('admin.vendor.inactive-vendor-details',compact('userData'));
    }

    public function updateVendorStatus(Request $request,$id)
    {
        $user = User::find($id);

        if ($user->status === 'active'){
            $user->status = 'inactive';
            $user->save();
            return redirect()->route('inactive.vendor')->with('success',"Vendor inactive successfully");
        }
        else{
            $user->status = 'active';
            $user->save();
            return redirect()->route('active.vendor')->with('success',"Vendor active successfully");
        }
    }
}
