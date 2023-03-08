<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function addSubCategory()
    {
        $category = Category::all();
        return view('admin.sub-category.add-sub-category',compact('category'));
    }

    public function allSubCategory()
    {
        $allData = SubCategory::all();
        return view('admin.sub-category.all-sub-category',compact('allData'));
    }

    public function editSubCategory($id)
    {
        $Data = SubCategory::find($id);
        $category = Category::all();
        return view('admin.sub-category.edit-sub-category',compact('category','Data'));
    }

    public function storeSubCategory(Request $request)
    {
        SubCategory::storeSubCategory($request);
        return redirect()->back()->with('success','Sub-Category save successfully');
    }

    public function updateSubCategory(Request $request, $id)
    {
        SubCategory::updateSubCategory($request,$id);
        return redirect()->route('all.sub.category')->with('success','Sub-Category update successfully');
    }

    public function deleteSubCategory($id)
    {
        $Data = SubCategory::find($id);
        $Data->delete();
        return redirect()->back()->with('success','Delete successfully');
    }

    public function subCatByCatAjax($id)
    {
        $subCat = Subcategory::where('category_id',$id)->get();
        return json_encode($subCat);
    }
}
