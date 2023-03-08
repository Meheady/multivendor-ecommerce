<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class VendorProductController extends Controller
{
    public function allVendorProduct()
    {
        $vendor = Auth::user()->id;
        $allData = Product::where('vendor_id',$vendor)->latest()->get();
        return view('vendor.product.all-product',compact('allData'));
    }
    public function addVendorProduct()
    {
        $brand = Brand::latest()->get();
        $category = Category::latest()->get();
        $subcat = SubCategory::latest()->get();
        return view('vendor.product.add-product',compact('brand','category','subcat'));

    }
    public function subCatByCatAjax($id)
    {
        $subCat = Subcategory::where('category_id',$id)->get();
        return json_encode($subCat);
    }
    public function storeVendorProduct(Request $request)
    {
        Product::storeVendorProduct($request);
        return redirect()->back()->with('success','Product save successfully');
    }

    public function editVendorProduct($id)
    {
        $multImages= MultiImage::where('product_id',$id)->get();
        $product = Product::find($id);
        $brand = Brand::latest()->get();
        $category = Category::latest()->get();
        $subcat = SubCategory::where('category_id',$product->category_id)->get();
        return view('vendor.product.edit-product',compact('product','brand','category','subcat','multImages'));

    }
    public function updateVendorProduct(Request $request, $id)
    {
        Product::updateVendorProduct($request,$id);
        return redirect()->route('all.vendor.product')->with('success','Product update successfully');
    }
    public function deleteVendorProduct($id)
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
        return redirect()->route('all.vendor.product')->with('success','Product delete successfully');
    }
    public function updateVendorProductThumb(Request $request,$id)
    {
        Product::updateVendorProductThumb($request,$id);
        return redirect()->route('all.vendor.product')->with('success','Product thumbnail update successfully');
    }
    public function updateVendorProductKultimg(Request $request)
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

    public function deleteVendorMultiimages($id)
    {
        $img = MultiImage::find($id);
        if (file_exists($img->photo_name)){
            unlink($img->photo_name);
            $img->delete();
        }
        return redirect()->back()->with('success','Product multi image delete successfully');
    }
    public function statusVendorProduct($id)
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
}
