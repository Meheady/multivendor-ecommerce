<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request,$id)
    {
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
                ]
            ]);
            return response()->json(['success'=>'Product added to cart']);
        }
    }
    public function addToCartDetails(Request $request,$id)
    {
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
        return response()->json(['success'=>'Removed product from cart']);
    }

    public function cartDec($id)
    {
        $row = Cart::get($id);
        Cart::update($id, $row->qty - 1);
        return response()->json('Decrement');
    }
    public function cartInc($id)
    {
        $row = Cart::get($id);
        Cart::update($id, $row->qty + 1);
        return response()->json('Increment');
    }

}
