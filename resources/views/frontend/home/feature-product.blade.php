<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>

        </div>
        @php
            $products = App\Models\Product::where('status',1)->where('featured',)->orderBy('id','desc')->limit(10)->get();
            $categories = App\Models\Category::orderBy('cat_name','ASC')->get();
        @endphp
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach($products as $item)
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                                <img class="default-img" src="{{asset($item->product_thumbnail)}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" id="{{ $item->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addTowishList(this.id)" ><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        @php
                                            $reviewAvg = App\Models\Review::where('product_id', $item->id)->where('status','1')->avg('rating');
                                                $amount = $item->selling_price - $item->discount_price;
                                                $discount =  ($amount/$item->selling_price) * 100;
                                                $vendor =  App\Models\User::where('id',$item->vendor_id)->first();
                                                $category =  App\Models\Category::where('id',$item->category_id)->first();
                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if($item->selling_price == NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot">Save {{ round($discount) }}%</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{ url('product/category/'.$category->id.'/'.$category->cat_slug) }}">{{ $category->cat_name }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a></h2>
                                        <div class="product-rate d-inline-block">
                                            @if($reviewAvg == 0)

                                            @elseif($reviewAvg == 1 || $reviewAvg < 2)
                                                <div class="product-rating" style="width: 20%"></div>
                                            @elseif($reviewAvg == 2 || $reviewAvg < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                            @elseif($reviewAvg == 3 || $reviewAvg < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                            @elseif($reviewAvg == 4 || $reviewAvg < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                            @elseif($reviewAvg == 5 || $reviewAvg < 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                            @endif
                                        </div>
                                        @if($item->discount_price == NULL)
                                            <div class="product-price mt-10 mb-10">
                                                <span>{{ $item->selling_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price mt-10 mb-10">
                                                <span>{{ $item->discount_price }}</span>
                                                <span class="old-price">{{ $item->selling_price }}</span>
                                            </div>
                                        @endif

{{--                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>--}}
{{--                                    --}}
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->


                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
