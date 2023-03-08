<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Slider extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getImage($image)
    {
        $imgExt = $image->getClientOriginalExtension();
        $imgName = time().'.'.$imgExt;
        $imgLocation = 'upload/slider/'.$imgName;
        Image::make($image)->resize(2376,807)->save($imgLocation);
        return $imgLocation;
    }

    public static function storeSlider($request)
    {
        Slider::insert([
            'slider_title'=> $request->title,
            'short_title'=> $request->title,
            'slider_image'=> self::getImage($request->file('photo')),
        ]);
    }

    public static function updateSlider($request,$id)
    {
        $slider = Slider::find($id);
        if ($request->file('photo')){
            if (file_exists($slider->slider_image)){
                unlink($slider->slider_image);
            }
            Slider::find($id)->update([
                'slider_title'=> $request->title,
                'short_title'=> $request->title,
                'slider_image'=> self::getImage($request->file('photo')),
            ]);
        }
        else {
            Slider::find($id)->update([
                'slider_title'=> $request->title,
                'short_title'=> $request->title,
            ]);
        }
    }
}
