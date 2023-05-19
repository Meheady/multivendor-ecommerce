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
        return view('admin.review.pending.review', compact('review'));
    }
    public function publishReview()
    {

    }
}
