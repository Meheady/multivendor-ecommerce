<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
