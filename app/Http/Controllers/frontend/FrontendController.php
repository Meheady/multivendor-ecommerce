<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function productDetails($id,$slug)
    {
        $product = Product::find($id);
        $multiImage = MultiImage::where('product_id',$id)->get();
        $category = Category::where('id',$product->category_id)->first();
        $subCat = SubCategory::where('id',$product->subcategory_id)->first();
        $brand = Brand::where('id',$product->brand_id)->first();
        $vendor = User::where('id',$product->vendor_id)->first();
        $productColor = explode(',',$product->product_color);
        $productSize = explode(',',$product->product_size);
        $relatedProduct = Product::where('category_id',$product->category_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        $data = [
          'product'=>$product,
          'multiImage'=>$multiImage,
          'category'=>$category,
            'color' => $productColor,
            'size'=>$productSize,
            'brand'=>$brand,
            'subCat'=>$subCat,
            'vendor'=>$vendor,
            'relatedProduct'=>$relatedProduct
        ];
        $amount = $product->selling_price - $product->discount_price;
        $discount =  ($amount/$product->selling_price) * 100;
        return view('frontend.product.product-details',compact('data','discount'));
    }
}
