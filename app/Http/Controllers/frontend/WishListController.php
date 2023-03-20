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
            $exist = WishList::where('user_id',Auth::user()->id)->where('product_id',$id)->first();
            if (!$exist){
                WishList::insert([
                   'user_id'=>Auth::user()->id,
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
}
