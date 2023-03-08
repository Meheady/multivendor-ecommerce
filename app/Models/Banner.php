<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Banner extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getImage($image)
    {
        $imgExt = $image->getClientOriginalExtension();
        $imgName = time().'.'.$imgExt;
        $imgLocation = 'upload/banner/'.$imgName;
        Image::make($image)->resize(768,450)->save($imgLocation);
        return $imgLocation;
    }

    public static function storeBanner($request)
    {
        Banner::insert([
            'banner_title'=> $request->title,
            'banner_url'=> $request->url,
            'banner_image'=> self::getImage($request->file('photo')),
        ]);
    }

    public static function updateBanner($request,$id)
    {
        $slider = Banner::find($id);
        if ($request->file('photo')){
            if (file_exists($slider->banner_image)){
                unlink($slider->banner_image);
            }
            Banner::find($id)->update([
                'banner_title'=> $request->title,
                'banner_url'=> $request->url,
                'banner_image'=> self::getImage($request->file('photo')),
            ]);
        }
        else {
            Banner::find($id)->update([
                'banner_title'=> $request->title,
                'banner_url'=> $request->url,
            ]);
        }
    }
}
