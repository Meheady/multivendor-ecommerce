<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
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
}
