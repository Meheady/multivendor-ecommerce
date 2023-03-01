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

    public function becomeVendor()
    {
        return view('auth.become-vendor');
    }

    public function registerVendor(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'vendor_join' => date('m-d-Y'),
            'role' => 'vendor',
            'status' => 'inactive',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('vendor.login')->with('success',"Vendor registered successfully");
    }
}
