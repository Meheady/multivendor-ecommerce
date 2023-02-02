<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.user.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        User::updateUserProfile($request, $id);
        return redirect()->back()->with('success','Update successfully done');

    }

    public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $request->validate([
           'oldpass'=>'required',
            'newpass' => 'required|confirmed'
        ]);
        if (!Hash::check($request->oldpass,$user->password)){
            return redirect()->back()->with('error','Your old password is not Match');
        }
        else{
            $user->password = Hash::make($request->newpass);
            $user->save();
            return redirect()->back()->with('success',"Password Change Successfully");
        }
    }
}
