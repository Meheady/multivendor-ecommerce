@extends('frontend.master')
@section('main')
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h4 class="mb-15">{{$cat->cat_name}}</h4>
                        <div class="breadcrumb">
                            <a href="{{ route('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>  <span></span> {{$cat->cat_name}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($product) }}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @foreach($product as $item)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                            <img class="default-img" src="{{asset($item->product_thumbnail)}}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addTowishList(this.id)" ><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" id="{{ $item->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount =  ($amount/$item->selling_price) * 100;
                                        $category =  App\Models\Category::where('id',$item->category_id)->first();
                                         $vendor =  App\Models\User::where('id',$item->vendor_id)->first();
                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($item->selling_price == NULL)
                                            <span class="new">New</span>
                                        @else
                                            <span class="hot">{{ round($discount) }}%</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $category->cat_name }}</a>
                                    </div>
                                    <h2><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a href="{{ route('vendor.details',$vendor->name) }}">{{ $vendor->name }}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        @if($item->discount_price == NULL)
                                            <div class="product-price">
                                                <span>{{ $item->selling_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>{{ $item->discount_price }}</span>
                                                <span class="old-price">{{ $item->selling_price }}</span>
                                            </div>
                                        @endif
{{--                                        <div class="add-cart">--}}
{{--                                            <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                    @endforeach
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!--End Deals-->


            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach($allCategory as $items)

                        <li>
                            @php
                                $products = App\Models\Product::where('category_id',$items->id)->get();

                            @endphp
                            <a href="{{ url('product/category/'.$items->id.'/'.$items->cat_slug) }}"> <img src="{{ asset($items->cat_image) }}" alt="" />{{ $items->cat_name }}</a><span class="count">{{ count($products) }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    @foreach($new as $item)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{asset($item->product_thumbnail)}}" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h5><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a></h5>

                            @if($item->discount_price == NULL)
                                <p class="price mb-0 mt-5">{{ $item->selling_price }}</p>
                            @else
                                <p class="price mb-0 mt-5">{{ $item->discount_price }}</p>
                            @endif
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                    <img src="assets/imgs/banner/banner-11.png" alt="" />
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br />
                            on <span class="text-brand">Oganic</span><br />
                            Juice
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
