<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CompareProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareProductController extends Controller
{
    public function addToCompare(Request $request, $id)
    {
        if (Auth::check()){
            $exist = CompareProduct::where('user_id',Auth::id())->where('product_id',$id)->first();
            if (!$exist){
                CompareProduct::insert([
                    'user_id'=>Auth::id(),
                    'product_id'=>$id,
                    'created_at'=> Carbon::now()
                ]);

                return response()->json(['success'=>'Product added to compare']);
            }
            else{
                return response()->json(['error'=>'Product already added to compare']);
            }
        }
        else{
            return response()->json(['error'=>'Login first for added to compare']);
        }
    }


    public function allCompareList()
    {
        return view('frontend.compare.compare-product');
    }


    public function getCompareList()
    {
        $comparelist = CompareProduct::with('product')->where('user_id',Auth::id())->get();
        $compareQty = count($comparelist);
        return response()->json(['comparelist'=>$comparelist,'compareQty'=>$compareQty]);
    }

    public function removeCompare($id)
    {
        CompareProduct::where('product_id',$id)->where('user_id',Auth::id())->delete();
        return response()->json(['success'=>'Removed product from Compare']);
    }
}
