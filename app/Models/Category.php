<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];


    public static function imgUpload($image)
    {

        $imgExt = $image->getClientOriginalExtension();
        $imgName = time().'.'.$imgExt;
        $imgPath = 'upload/category/';
        Image::make($image)->resize(120,120)->save($imgPath.$imgName);
        return $imgUrl = $imgPath.$imgName;
    }


    public static function storeCategory($request)
    {
        Category::insert([
           'cat_name'=>$request->name,
           'cat_slug'=>strtolower(str_ireplace(' ','-',$request->name)),
           'cat_image'=>self::imgUpload($request->file('photo')),
        ]);
    }

    public static function updateCategory($request,$id)
    {
        $category = Category::find($id);
        if ($request->file('photo')){
            if (file_exists($category->cat_image)){
                unlink($category->cat_image);
            }
            $imgUrl = self::imgUpload($request->file('photo'));
        }
        else {
            $imgUrl = $category->cat_image;
        }

        $category->cat_image = $imgUrl;
        $category->cat_name = $request->name;
        $category->save();
    }
}
