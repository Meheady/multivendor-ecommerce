<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        $skip_cat_0 = Category::skip(0)->first();
        $skip_prod_0 = Product::where('status',1)->where('category_id',$skip_cat_0->id)->orderBy('id','DESC')->limit(5)->get();
        $skip_cat_1 = Category::skip(1)->first();
        $skip_prod_1 = Product::where('status',1)->where('category_id',$skip_cat_1->id)->orderBy('id','DESC')->limit(5)->get();
        $skip_cat_2 = Category::skip(2)->first();
        $skip_prod_2 = Product::where('status',1)->where('category_id',$skip_cat_2->id)->orderBy('id','DESC')->limit(5)->get();
        $hotDeal = Product::where('status',1)->where('hot_deals','1')->orderBy('id','DESC')->limit(3)->get();
        $specialOffer = Product::where('status',1)->where('special_offer','1')->orderBy('id','DESC')->limit(3)->get();
        $specialDeals = Product::where('status',1)->where('special_deals','1')->orderBy('id','DESC')->limit(3)->get();
        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $allVendor = User::where('status','active')->where('role','vendor')->orderBy('id','ASC')->limit(4)->get();
        return view('frontend.index',compact(
            'skip_cat_0','skip_prod_0',
            'skip_cat_1','skip_prod_1',
            'skip_cat_2','skip_prod_2','hotDeal','specialOffer','specialDeals','new','allVendor',
        ));
    }
    public function productDetails($id,$slug)
    {
        $product = Product::find($id);
        $review = Review::where('product_id', $id)->where('status','1')->latest()->limit(6)->get();
        $reviewAvg = Review::where('product_id', $id)->where('status','1')->avg('rating');
        $multiImage = MultiImage::where('product_id',$id)->get();
        $category = Category::where('id',$product->category_id)->first();
        $subCat = SubCategory::where('id',$product->subcategory_id)->first();
        $brand = Brand::where('id',$product->brand_id)->first();
        $vendor = User::where('id',$product->vendor_id)->first();
        $productColor = explode(',',$product->product_color);
        $productSize = explode(',',$product->product_size);
        $shareComponent = \Share::page(
            'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
        $relatedProduct = Product::where('category_id',$product->category_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        $data = [
          'product'=>$product,
          'multiImage'=>$multiImage,
          'category'=>$category,
            'color' => $productColor,
            'size'=>$productSize,
            'brand'=>$brand,
            'subCat'=>$subCat,
            'vendor'=>$vendor,
            'relatedProduct'=>$relatedProduct,
            'review'=>$review,
            'reviewAvg'=>$reviewAvg,
        ];
        $amount = $product->selling_price - $product->discount_price;
        $discount =  ($amount/$product->selling_price) * 100;
        return view('frontend.product.product-details',compact('data','discount','shareComponent'));
    }

    public function vendorDetails($id)
    {
        $vendor = User::find($id);
        $product = Product::where('vendor_id',$id)->where('status','1')->get();
        return view('frontend.vendor.vendor-details',compact('vendor','product'));
    }

    public function allVendor()
    {
        $allVendor = User::where('status','active')->where('role','vendor')->orderBy('id','ASC')->get();
        return view('frontend.vendor.all-vendor',compact('allVendor'));
    }

    public function catWiseProduct($id,$slug)
    {
        $product = Product::where('category_id',$id)->where('status','1')->get();
        $allCategory = Category::orderBy('cat_name','ASC')->get();
        $cat = Category::find($id);
        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.category-wise',compact('allCategory','product','cat','new'));
    }
    public function subCatWiseProduct($id,$slug)
    {
        $product = Product::where('subcategory_id',$id)->where('status','1')->get();
        $allCategory = Category::orderBy('cat_name','ASC')->get();
        $subCat = SubCategory::find($id);
        $cat = Category::find($subCat->category_id);
        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.sub-category-wise',compact('allCategory','product','cat','new','subCat'));
    }


    public function productModalView($id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        $brand = Brand::find($product->brand_id);
        $productColor = explode(',',$product->product_color);
        $productSize = explode(',',$product->product_size);
        $data = [
            'product'=>$product,
            'category'=>$category,
            'brand'=>$brand,
            'pcolor'=>$productColor,
            'psize'=>$productColor
        ];

        return response()->json($data);

    }

    public function productSearch(Request $request)
    {
        $item = $request->search;

        $product = Product::where('product_name','LIKE', "%$item%")->get();
        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();

        $categories = DB::table('categories')
            ->leftJoin('products','products.category_id','=','categories.id')
            ->select('categories.*',DB::raw('count(products.id) as product_count'))
            ->groupBy('categories.id')
            ->get();
        return view('frontend.product.search',compact('product','item','new','categories'));
    }


    public function ajaxProductSearch(Request $request)
    {
        $item = $request->search;

        $product = Product::where('product_name','LIKE', "%$item%")
            ->select('id','product_name','product_thumbnail','selling_price','product_slug')
        ->limit(6)
            ->get();
        return view('frontend.product.ajax-search',compact('product'));
    }

    public function shopProduct()
    {
        $product = Product::query();

        if(!empty($_GET['category'])){
            $slugs = explode(',',$_GET['category']);
            $catIds =  Category::select('id')->whereIn('cat_slug',$slugs)->pluck('id')->toArray();
            $product = Product::whereIn('category_id',$catIds)->orderBy('id','DESC')->get();
        }
        elseif(!empty($_GET['brand'])){
            $slugs = explode(',',$_GET['brand']);
            $brandIds =  Brand::select('id')->whereIn('brand_slug',$slugs)->pluck('id')->toArray();
            $product = Product::whereIn('brand_id',$brandIds)->orderBy('id','DESC')->get();
        }
        else{
            $product = Product::latest()->get();
        }
        if(!empty($_GET['price'])){
            $price = explode('-',$_GET['price']);
            $product = Product::whereBetween('selling_price',$price)->orderBy('id','DESC')->get();
        }


        $brands = Brand::latest()->get();
        $categories = DB::table('categories')
            ->leftJoin('products','products.category_id','=','categories.id')
            ->select('categories.*',DB::raw('count(products.id) as product_count'))
            ->groupBy('categories.id')
            ->get();

        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.shop-page',compact('product','new','categories','brands'));
    }

    public function shopFilter(Request $request)
    {
        $data = $request->all();

        $catUrl = "";
        if(!empty($data['category'])){
            foreach($data['category'] as $item){
                if(empty($catUrl)){
                    $catUrl .= "&category=".$item;
                }
                else{
                    $catUrl .= ",".$item;
                }
            }
        }


        $brandUrl = "";
        if(!empty($data['brand'])){
            foreach($data['brand'] as $item){
                if(empty($brandUrl)){
                    $brandUrl .= "&brand=".$item;
                }
                else{
                    $brandUrl .= ",".$item;
                }
            }
        }
        $priceUrl = "";
        if(!empty($data['price_range'])){
                if(empty($priceUrl)){
                    $brandUrl .= "&price=".$data['price_range'];
                }
        }

        return redirect()->route('shop',$catUrl.$brandUrl.$priceUrl);
    }


    public function contactUs()
    {
        return view('frontend.others.contact');
    }

    public function saveContactUs(Request $request)
    {
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ];

        $contact = Contact::create($data);
        Mail::to('hmmehedi55@gmail.com')->send(new ContactMail($data));

        return redirect()->back()->with('success','SuccessfullyY submitted, we will reply soon');
    }
}
