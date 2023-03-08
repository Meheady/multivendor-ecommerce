<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    public static function getThumbImg($image)
    {
        $imgExt = $image->getClientOriginalExtension();
        $imgName = time().'.'.$imgExt;
        $imgLocation = 'upload/products/thumbnail/'.$imgName;
        Image::make($image)->resize(800,800)->save($imgLocation);
        return $imgLocation;

    }

    public static function storeProduct($request)
    {
        $productId = Product::insertGetId([
           'brand_id'=>$request->brand,
           'category_id'=>$request->category,
           'subcategory_id'=>$request->Sub_category,
           'vendor_id'=>$request->vendor,

           'product_name'=>$request->product_name,
           'product_slug'=>str_replace(' ','-',$request->product_name),
           'product_code'=>$request->product_code,
           'product_qty'=>$request->qty,
           'product_tags'=>$request->product_tags,
           'product_size'=>$request->product_size,
           'product_color'=>$request->product_color,
           'selling_price'=>$request->selling_price,
           'discount_price'=>$request->discount,
           'short_desc'=>$request->short_desc,
           'long_desc'=>$request->long_desc,
           'product_thumbnail'=>self::getThumbImg($request->file('thumb_img')),
           'hot_deals'=>$request->hotdeal,
           'featured'=>$request->featured,
           'special_offer'=>$request->spoffer,
           'special_deals'=>$request->spdeal,
           'status'=>'1',
            'created_at'=>Carbon::now()
        ]);

        $multiImg = $request->file('multi_img');

        foreach ($multiImg as $key =>$img){

            $imgExt = $img->getClientOriginalExtension();
            $imgName = $key.time().'.'.$imgExt;
            $imgLocation = 'upload/products/multi-image/'.$imgName;
            Image::make($img)->resize(800,800)->save($imgLocation);

            MultiImage::insert([
                'product_id'=>$productId,
                'photo_name'=>$imgLocation,
                'created_at'=>Carbon::now()
        ]);
        }
    }
    public static function storeVendorProduct($request)
    {
        $productId = Product::insertGetId([
           'brand_id'=>$request->brand,
           'category_id'=>$request->category,
           'subcategory_id'=>$request->Sub_category,
           'vendor_id'=>Auth::user()->id,
           'product_name'=>$request->product_name,
           'product_slug'=>str_replace(' ','-',$request->product_name),
           'product_code'=>$request->product_code,
           'product_qty'=>$request->qty,
           'product_tags'=>$request->product_tags,
           'product_size'=>$request->product_size,
           'product_color'=>$request->product_color,
           'selling_price'=>$request->selling_price,
           'discount_price'=>$request->discount,
           'short_desc'=>$request->short_desc,
           'long_desc'=>$request->long_desc,
           'product_thumbnail'=>self::getThumbImg($request->file('thumb_img')),
           'hot_deals'=>$request->hotdeal,
           'featured'=>$request->featured,
           'special_offer'=>$request->spoffer,
           'special_deals'=>$request->spdeal,
           'status'=>'1',
            'created_at'=>Carbon::now()
        ]);
        $multiImg = $request->file('multi_img');
        foreach ($multiImg as $key =>$img){
            $imgExt = $img->getClientOriginalExtension();
            $imgName = $key.time().'.'.$imgExt;
            $imgLocation = 'upload/products/multi-image/'.$imgName;
            Image::make($img)->resize(800,800)->save($imgLocation);
            MultiImage::insert([
                'product_id'=>$productId,
                'photo_name'=>$imgLocation,
                'created_at'=>Carbon::now()
        ]);
        }
    }
    public static function updateProduct($request,$id)
    {

        Product::find($id)->update([
            'brand_id'=>$request->brand,
            'category_id'=>$request->category,
            'subcategory_id'=>$request->Sub_category,
            'vendor_id'=>$request->vendor,
            'product_name'=>$request->product_name,
            'product_slug'=>str_replace(' ','-',$request->product_name),
            'product_code'=>$request->product_code,
            'product_qty'=>$request->qty,
            'product_tags'=>$request->product_tags,
            'product_size'=>$request->product_size,
            'product_color'=>$request->product_color,
            'selling_price'=>$request->selling_price,
            'discount_price'=>$request->discount,
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,
            'hot_deals'=>$request->hotdeal,
            'featured'=>$request->featured,
            'special_offer'=>$request->spoffer,
            'special_deals'=>$request->spdeal,
            'status'=>'1',
            'created_at'=>Carbon::now()
        ]);
    }
    public static function updateVendorProduct($request,$id)
    {

        Product::find($id)->update([
            'brand_id'=>$request->brand,
            'category_id'=>$request->category,
            'subcategory_id'=>$request->Sub_category,
            'product_name'=>$request->product_name,
            'product_slug'=>str_replace(' ','-',$request->product_name),
            'product_code'=>$request->product_code,
            'product_qty'=>$request->qty,
            'product_tags'=>$request->product_tags,
            'product_size'=>$request->product_size,
            'product_color'=>$request->product_color,
            'selling_price'=>$request->selling_price,
            'discount_price'=>$request->discount,
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,
            'hot_deals'=>$request->hotdeal,
            'featured'=>$request->featured,
            'special_offer'=>$request->spoffer,
            'special_deals'=>$request->spdeal,
            'status'=>'1',
            'created_at'=>Carbon::now()
        ]);
    }

    public static function updateProductThumb($request,$id)
    {
        $product = Product::find($id);
        if(file_exists($product->product_thumbnail)){
            unlink($product->product_thumbnail);
        }
        $product->product_thumbnail = self::getThumbImg($request->file('thumb_img'));
          $product->created_at = Carbon::now();
          $product->save();
    }
    public static function updateVendorProductThumb($request,$id)
    {
        $product = Product::find($id);
        if(file_exists($product->product_thumbnail)){
            unlink($product->product_thumbnail);
        }
        $product->product_thumbnail = self::getThumbImg($request->file('thumb_img'));
          $product->created_at = Carbon::now();
          $product->save();
    }
}
