<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
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
}
