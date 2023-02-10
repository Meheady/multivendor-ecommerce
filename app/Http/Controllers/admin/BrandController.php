<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand()
    {
        $allData = Brand::all();
        return view('admin.brand.all-brand',compact('allData'));
    }
    public function addBrand()
    {
        return view('admin.brand.add-brand');
    }
    public function storeBrand(Request $request)
    {
        Brand::storeBrand($request);
        return redirect()->back()->with('success', 'Brand added successfully');
    }

}
