<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function allUser()
    {
        $user = User::where('role','user')->get();
        return view('admin.user.all-user',compact('user'));
    }
    public function allVendor()
    {
        $user = User::where('role','vendor')->get();
        return view('admin.user.all-vendor',compact('user'));
    }
}
