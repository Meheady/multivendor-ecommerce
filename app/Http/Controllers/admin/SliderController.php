<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function allSlider()
    {
        $sliders = Slider::all();
        return view('admin.slider.all-slider',compact('sliders'));
    }
    public function createSlider()
    {
        return view('admin.slider.add-slider');
    }
    public function storeSlider(Request $request)
    {
        Slider::storeSlider($request);
        return redirect()->back()->with('success','Slider added success');
    }
    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit-slider',compact('slider'));
    }
    public function updateSlider(Request $request,$id)
    {
        Slider::updateSlider($request,$id);
        return redirect()->route('all.slider')->with('success','Slider update success');
    }
    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        if (file_exists($slider->slider_image)){
            unlink($slider->slider_image);
            $slider->delete();
        }
        return redirect()->back()->with('success','Slider delete success');
    }
}
