<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand()
    {
        $allData = Brand::latest()->get();
        return view('admin.brand.all-brand',compact('allData'));
    }
    public function addBrand()
    {
        return view('admin.brand.add-brand');
    }
    public function storeBrand(Request $request)
    {
        $request->validate([
           'name'=> 'required',
           'photo'=>'required|image'
        ]);
        Brand::storeBrand($request);
        return redirect()->back()->with('success', 'Brand added successfully');
    }

    public function editBrand($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit-brand',compact('brand'));
    }

    public function updateBrand(Request $request,$id)
    {
        Brand::updateBrand($request,$id);
        return redirect()->route('all.brand')->with('success', 'Brand update successfully');
    }

}
