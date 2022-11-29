<?php

namespace App\Http\Controllers\sociallogin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $findUser = User::where('facebook_id',$user->id)->first();

        if ($findUser){
            Auth::login($findUser);
            return redirect('/dashboard');
        }
        else {
            $newUser = new  User();
            $newUser->name  = $user->name;
            $newUser->email  = $user->email;
            $newUser->facebook_id  = $user->id;
            $newUser->password  = bcrypt('12345');

            $newUser->save();
            Auth::login($newUser);
            return redirect('/dashboard');
        }
    }
}
