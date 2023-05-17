<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded =[];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function imageUpload($image,$location)
    {
        $imgExt = $image->getClientOriginalExtension();
        $imgName = time()."profile-image".'.'.$imgExt;
        $location = $location;
        $image->move($location,$imgName);
        return $imgUrl = $location.$imgName;
    }

    public static function updateAdminUser($request,$id)
    {

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if ($request->file('photo')){
            if (file_exists($user->photo)){
                unlink($user->photo);
            }
            $user->photo = self::imageUpload($request->file('photo'),"upload/admin-images/");
        }

        $user->save();

    }

    public static function updateVendorProfile($request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->vendor_join = $request->vendor_join;
        $user->vendor_info = $request->vendor_info;
        if ($request->file('photo')){
            if (file_exists($user->photo)){
                unlink($user->photo);
            }
            $user->photo = self::imageUpload($request->file('photo'),"upload/vendor-images/");
        }

        $user->save();

    }

    public static function updateUserProfile($request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if ($request->file('photo')){
            if (file_exists($user->photo)){
                unlink($user->photo);
            }
            $user->photo = self::imageUpload($request->file('photo'),"upload/user-images/");
        }

        $user->save();
    }

    public static function changePassword($request)
    {
        User::whereId(Auth::user()->id)->update([
            'password'=>Hash::make($request->newpass),
        ]);
    }

    public static function cngVendorPassword($request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->password = Hash::make($request->newpass);
        $user->save();
    }

    public function userOnline()
    {
        return Cache::has('user-online'.$this->id);
    }
}
