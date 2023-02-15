<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function imgUpload($image,$name)
    {
        $brandName = strtolower(str_ireplace(' ','-',$name));
        $imgExt = $image->getClientOriginalExtension();
        $imgName = $brandName.'_'.time().'.'.$imgExt;
        $imgPath = 'upload/brand/';
        Image::make($image)->resize(300,300)->save($imgPath.$imgName);
        return $imgUrl = $imgPath.$imgName;
    }

    public static function storeBrand($request)
    {
        Brand::insert([
           'brand_name'=> $request->name,
           'brand_slug' => strtolower(str_ireplace(' ','-',$request->name)),
           'brand_image' =>  self::imgUpload($request->file('photo'),$request->name)
        ]);
    }

    public static function updateBrand($request,$id)
    {
        $brand = Brand::find($id);
        if ($request->file('photo')){
            if (file_exists($brand->brand_image)){
                unlink($brand->brand_image);
            }
            $imgUrl = self::imgUpload($request->file('photo'),$request->name);
        }
        else {
            $imgUrl = $brand->brand_image;
        }
        $brand->brand_image = $imgUrl;
        $brand->brand_name = $request->name;
        $brand->save();
    }
}
