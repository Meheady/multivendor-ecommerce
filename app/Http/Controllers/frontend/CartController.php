<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request,$id)
    {

        if (Session::has('coupon')){
            Session::forget('coupon');
        }
        $product = Product::find($id);

        if ($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->pName,
                'qty' => $request->pQty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'size' => $request->pSize,
                    'color' => $request->pColor,
                    'image' => $product->product_thumbnail,
                    'vendor_id' => $request->vendorId,
                ]
            ]);
            return response()->json(['success'=>'Product added to cart']);
        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->pName,
                'qty' => $request->pQty,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'size' => $request->pSize,
                    'color' => $request->pColor,
                    'image' => $product->product_thumbnail,
                    'vendor_id' => $request->vendorId,
                ]
            ]);
            return response()->json(['success'=>'Product added to cart']);
        }
    }
    public function addToCartDetails(Request $request,$id)
    {
        if (Session::has('coupon')){
            Session::forget('coupon');
        }
        $product = Product::find($id);

        if ($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->pName,
                'qty' => $request->pQty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'size' => $request->pSize,
                    'color' => $request->pColor,
                    'image' => $product->product_thumbnail,
                    'vendor_id' => $request->vendorId,
                ]
            ]);
            return response()->json(['success'=>'Product added to cart']);
        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->pName,
                'qty' => $request->pQty,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'size' => $request->pSize,
                    'color' => $request->pColor,
                    'image' => $product->product_thumbnail,
                    'vendor_id' => $request->vendorId,
                ]
            ]);
            return response()->json(['success'=>'Product added to cart']);
        }
    }

    public function addMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
           'carts'=>$carts,
           'cartQty'=> $cartQty,
           'cartTotal'=>$cartTotal
        ]);

    }

    public function removeMiniCart($id)
    {
        $remove = Cart::remove($id);
        if (Session::has('coupon')){
            $couponName = session()->get('coupon')['coupon'];
            $coupon = Coupon::where('coupon_name',$couponName)->first();
            Session::put('coupon',[
                'coupon'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }
        return response()->json(['success'=>'Removed product from cart']);

    }

    public function myCart()
    {

        return view('frontend.cart.my-cart');
    }

    public function getMyCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts'=>$carts,
            'cartQty'=> $cartQty,
            'cartTotal'=>$cartTotal
        ]);
    }

    public function removeMyCart($id)
    {
        $remove = Cart::remove($id);
        if (Session::has('coupon')){
            $couponName = session()->get('coupon')['coupon'];
            $coupon = Coupon::where('coupon_name',$couponName)->first();
            Session::put('coupon',[
                'coupon'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }
        return response()->json(['success'=>'Removed product from cart']);
    }

    public function cartDec($id)
    {

        $row = Cart::get($id);
        Cart::update($id, $row->qty - 1);
        if (Session::has('coupon')){
            $couponName = session()->get('coupon')['coupon'];
            $coupon = Coupon::where('coupon_name',$couponName)->first();
            Session::put('coupon',[
                'coupon'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }
        return response()->json('Decrement');
    }
    public function cartInc($id)
    {
        $row = Cart::get($id);
        Cart::update($id, $row->qty + 1);
        if (Session::has('coupon')){
            $couponName = session()->get('coupon')['coupon'];
            $coupon = Coupon::where('coupon_name',$couponName)->first();
            Session::put('coupon',[
                'coupon'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }
        return response()->json('Increment');
    }
    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name',$request->coupon)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon){
            Session::put('coupon',[
                'coupon'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
            return response()->json([
                'validity'=>true,
                'success'=>'Coupon applied successfully'
            ]);
        }
        else{
            return response()->json([
                'error'=>'Coupon Invalid'
            ]);
        }
    }

    public function couponCalculation()
    {
        if (Session::has('coupon')){
            return response()->json([
                'subTotal'=>Cart::total(),
                'coupon_name'=> session()->get('coupon')['coupon'],
                'coupon_discount'=> session()->get('coupon')['coupon_discount'],
                'discount_amount'=> session()->get('coupon')['discount_amount'],
                'total_amount'=> session()->get('coupon')['total_amount'],
            ]);
        }
        else{
            return response()->json([
                'total'=>Cart::total(),
            ]);
        }
    }
    public function couponRemove()
    {
        Session::forget('coupon');
        return response()->json([
            'success'=> "Coupon remove successfully"
        ]);
    }
    public function checkOutPage()
    {
        if (Auth::check()){

            if (Cart::total() > 0){

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $division = ShipDivision::all();

                return view('frontend.checkout.checkout-view',compact(
                    'carts',
                    'cartQty','cartTotal','division'));
            }
            else{
                return redirect()->route('/')->with('error','Your cart is empty');
            }
        }
        else{
            return redirect()->route('login')->with('error','Your must login');
        }
    }

}
