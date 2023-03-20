<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addToWishlist(Request $request, $id)
    {
        if (Auth::check()){
            $exist = WishList::where('user_id',Auth::id())->where('product_id',$id)->first();
            if (!$exist){
                WishList::insert([
                   'user_id'=>Auth::id(),
                   'product_id'=>$id,
                    'created_at'=> Carbon::now()
                ]);

                return response()->json(['success'=>'Product added to wishlist']);
            }
            else{
                return response()->json(['error'=>'Product already added to wishlist']);
            }
        }
        else{
            return response()->json(['error'=>'Login first for added to wishlist']);
        }

    }

    public function allWishList()
    {
        $wishlist = WishList::where('user_id',Auth::user()->id)->get();
        return view('frontend.wishlist.all-wishlist',compact('wishlist'));
    }

    public function getWishList()
    {
        $wishlist = WishList::with('product')->where('user_id',Auth::id())->get();
        $wishQty = count($wishlist);
        return response()->json(['wishlist'=>$wishlist,'wishQty'=>$wishQty]);
    }

    public function removeWishList($id)
    {
        WishList::find($id)->delete();
        return response()->json(['success'=>'Removed product from wishlist']);
    }
}
