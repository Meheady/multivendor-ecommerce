<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        return view('vendor.index');
    }

    public function vendorLogin()
    {
        return view('vendor.vendor-login');
    }

    public function VendorLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/vendor/login');
    }

    public function VendorProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('vendor.vendor-profile',compact('userData'));
    }

    public function UpdateVendorProfile(Request $request,$id)
    {
        User::updateVendorProfile($request, $id);
        return redirect()->back()->with('success','Profile Update Successfully');
    }

    public function VendorChangePassword()
    {
        return view('vendor.vendor-cng-password');
    }
    public function VendorChangePasswordSave(Request $request)
    {
        $request->validate([
            'oldpass'=>'required',
            'newpass'=>'required|confirmed'
        ]);
        if (!Hash::check($request->oldpass,Auth::user()->password)){
            return redirect()->back()->with('error',"Old Password Doesn't Match");
        }
        else {
            User::cngVendorPassword($request);
            return redirect()->back()->with('success',"Password Change Successfully");
        }
    }
}
