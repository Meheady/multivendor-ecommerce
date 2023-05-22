<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function addProduct()
    {
        $brand = Brand::latest()->get();
        $category = Category::latest()->get();
        $subcat = SubCategory::latest()->get();
        $vendor = User::where('role','vendor')->where('status','active')->latest()->get();

        return view('admin.product.add-product',compact('brand','category','subcat','vendor'));
    }
    public function allProduct()
    {
        $allData = Product::latest()->get();
        return view('admin.product.all-product',compact('allData'));
    }
    public function storeProduct(Request $request)
    {
        Product::storeProduct($request);
        return redirect()->back()->with('success','Product save successfully');
    }
    public function editProduct($id)
    {
        $multImages= MultiImage::where('product_id',$id)->get();
        $product = Product::find($id);
        $brand = Brand::latest()->get();
        $category = Category::latest()->get();
        $subcat = SubCategory::where('category_id',$product->category_id)->get();
        $vendor = User::where('role','vendor')->where('status','active')->latest()->get();
        return view('admin.product.edit-product',compact('product','brand','category','subcat','vendor','multImages'));

    }
    public function updateProduct(Request $request, $id)
    {
        Product::updateProduct($request,$id);
        return redirect()->route('all.product')->with('success','Product update successfully');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (file_exists($product->product_thumbnail)){
            unlink($product->product_thumbnail);
            $product->delete();
        }
        $multiImg = MultiImage::where('product_id',$id)->get();
        foreach ($multiImg as $img){
            if (file_exists($img->photo_name)){
                unlink($img->photo_name);
            }
            $img->delete();
        }
        return redirect()->route('all.product')->with('success','Product delete successfully');
    }
    public function updateProductThumb(Request $request,$id)
    {
        Product::updateProductThumb($request,$id);
        return redirect()->route('all.product')->with('success','Product thumbnail update successfully');
    }
    public function updateProductKultimg(Request $request)
    {
        $imgs = $request->multi_img;
        foreach ($imgs as $id=>$img){
            $imgdel = MultiImage::find($id);
            unlink($imgdel->photo_name);
            $imgExt = $img->getClientOriginalExtension();
            $imgName = $id.time().'.'.$imgExt;
            $imgLocation = 'upload/products/multi-image/'.$imgName;
            Image::make($img)->resize(800,800)->save($imgLocation);

            MultiImage::where('id',$id)->update([
                'photo_name'=>$imgLocation,
                'created_at'=>Carbon::now()
            ]);
        }
        return redirect()->back()->with('success','Product thumbnail update successfully');
    }

    public function deleteMultiimages($id)
    {
        $img = MultiImage::find($id);
        if (file_exists($img->photo_name)){
            unlink($img->photo_name);
            $img->delete();
        }
        return redirect()->back()->with('success','Product multi image delete successfully');
    }
    public function statusProduct($id)
    {
        $product = Product::find($id);

        if ($product->status == 1){
            $product->status = 0;
            $product->save();
            return redirect()->back()->with('success','Product Inactive successfully');
        }else{
            $product->status = 1;
            $product->save();
            return redirect()->back()->with('success','Product Active successfully');
        }

    }

    public function productStock()
    {
        $allData = Product::latest()->get();
        return view('admin.product.product-stock',compact('allData'));
    }

}
