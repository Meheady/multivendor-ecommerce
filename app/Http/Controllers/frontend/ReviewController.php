<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeReview(Request $request)
    {
        Review::insert([
            'product_id'=> $request->product_id,
            'vendor_id'=> $request->vendor_id,
            'user_id'=> Auth::user()->id,
            'rating'=> $request->quality,
            'comment'=> $request->comment,
        ]);

        return redirect()->back()->with('success','Review added successfully');
    }

    public function pendingReview()
    {
        $review = Review::where('status','0')->orderBy('id','DESC')->get();
        return view('admin.review.pending-review', compact('review'));
    }
    public function publishReview()
    {
        $review = Review::where('status','1')->orderBy('id','DESC')->get();
        return view('admin.review.publish-review', compact('review'));
    }
    public function approveReview($id)
    {
        Review::where('id',$id)->update(['status'=>1]);
        return redirect()->back()->with('success','Review approve successfully');
    }
    public function deleteReview($id)
    {
        Review::where('id',$id)->delete();
        return redirect()->back()->with('success','Review delete successfully');
    }

    public function vendorReview()
    {
        $review = Review::where('vendor_id', Auth::user()->id)->orderBy('id','DESC')->get();
        return view('vendor.review.publish-review', compact('review'));
    }
}
