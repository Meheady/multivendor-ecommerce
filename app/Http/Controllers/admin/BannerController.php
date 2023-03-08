<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function allBanner()
    {
        $banners = Banner::all();
        return view('admin.banner.all-banner',compact('banners'));
    }
    public function createBanner()
    {
        return view('admin.banner.add-banner');
    }
    public function storeBanner(Request $request)
    {
        Banner::storeBanner($request);
        return redirect()->back()->with('success','Banner added success');
    }
    public function editBanner($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit-banner',compact('banner'));
    }
    public function updateBanner(Request $request,$id)
    {
        Banner::updateBanner($request,$id);
        return redirect()->route('all.banner')->with('success','Banner update success');
    }
    public function deleteBanner($id)
    {
        $banner = Banner::find($id);
        if (file_exists($banner->banner_image)){
            unlink($banner->banner_image);
            $banner->delete();
        }
        return redirect()->back()->with('success','Banner delete success');
    }
}
