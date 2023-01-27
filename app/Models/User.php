<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public static function imageUpload($image)
    {
        $imgExt = $image->getClientOriginalExtension();
        $imgName = time()."admin-profile-image".$imgExt;
        $location = "upload/admin-images/";
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
            $user->photo = self::imageUpload($request->file('photo'));
        }

        $user->save();

    }
}
