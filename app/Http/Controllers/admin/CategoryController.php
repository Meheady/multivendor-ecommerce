<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('admin.category.add-category');
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'photo' =>'required|image'
        ]);
        Category::storeCategory($request);
        return redirect()->back()->with('massage','Category save successfully');

    }

    public function allCategory()
    {
        $allData = Category::latest()->get();
        return view('admin.category.all-category',compact('allData'));
    }

    public function deleteCategory($id)
    {

    }
    public function editCategory($id)
    {

    }
    public function updateCategory(Request $request, $id)
    {
        Category::updateCategory($request,$id);
    }
}
