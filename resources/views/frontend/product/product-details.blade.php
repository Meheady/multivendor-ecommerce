@extends('frontend.master')
@section('main')
    <style>
        div#social-links ul li {
            display: inline-block;
        }
        div#social-links ul li a {
            padding: 5px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 20px;
            color: #222;
            background-color: #ccc;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="shop-grid-right.html">{{ $data['category']['cat_name'] }}</a> <span></span> {{ $data['subCat']['sub_cat_name'] }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    @foreach($data['multiImage'] as $img)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($img->photo_name) }}" alt="product image" />
                                    </figure>
                                    @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    @foreach($data['multiImage'] as $img)
                                    <div><img src="{{ asset($img->photo_name) }}" alt="product image" /></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                @if($data['product']['product_qty'] > 0)
                                    <span class="stock-status in-stock"> In Stock</span>
                                    @else
                                    <span class="stock-status out-stock"> Stock Out </span>
                                    @endif
                                <h2 class="title-detail" id="dpname">{{ $data['product']['product_name'] }}</h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">

                                            @if($data['reviewAvg'] == 0)

                                            @elseif($data['reviewAvg'] == 1 || $data['reviewAvg'] < 2)
                                                <div class="product-rating" style="width: 20%"></div>
                                            @elseif($data['reviewAvg'] == 2 || $data['reviewAvg'] < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                            @elseif($data['reviewAvg'] == 3 || $data['reviewAvg'] < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                            @elseif($data['reviewAvg'] == 4 || $data['reviewAvg'] < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                            @elseif($data['reviewAvg'] == 5 || $data['reviewAvg'] < 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                            @endif

                                        </div>
                                        <span class="font-small ml-5 text-muted"> {{ count($data['review']) }} review </span>
                                    </div>
                                </div>

                                <div class="clearfix product-price-cover">
                                    @if($data['product']['discount_price'] == NULL)
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">{{ $data['product']['selling_price'] }}</span>
                                    </div>
                                        @else
                                        <div class="product-price primary-color float-left">
                                            <span class="current-price text-brand">{{ $data['product']['discount_price'] }}</span>
                                            <span>
                                                <span class="save-price font-md color3 ml-15">{{ round($discount) }}% Off</span>
                                                <span class="old-price font-md ml-15">{{ $data['product']['selling_price'] }}</span>
                                            </span>
                                        </div>
                                    @endif

                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">{{ $data['product']['short_desc'] }}</p>
                                </div>
                                    @if($data['product']['product_size'] !== NULL)
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10">Size: </strong>
                                            <select name="" class="form-control unicase-form-control" id="dpsize">
                                                <option selected disabled>Choose size</option>
                                                @foreach($data['size'] as $item)
                                                    <option value="{{ $item }}">{{ ucwords($item) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if($data['product']['product_color'] !== NULL)
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10">Color: </strong>
                                            <select name="" class="form-control unicase-form-control" id="dpcolor">
                                                <option selected disabled>Choose color</option>
                                                @foreach($data['color'] as $item)
                                                    <option value="{{ $item }}">{{ ucwords($item) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                <div class="detail-extralink mb-50">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" id="dqty" class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <input type="hidden" id="d_p_id" name="d_p_id" value="{{ $data['product']['id']  }}">
                                        <button type="submit" onclick="addToCartPdetails()" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                                    @if($data['vendor']['name'] !== NULL)
                                    <h5>Sold By <a href="#"><span class="text-danger">{{ $data['vendor']['name'] }}</span></a></h5>
                                    @else
                                        <h5>Sold By <a href="#"><span class="text-danger">Owner</span></a></h5>
                                    @endif

                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">Brand: <span class="text-brand">{{ $data['brand']['brand_name'] }}</span></li>
                                        <li class="mb-5">Category:<span class="text-brand">{{ $data['category']['cat_name'] }}</span></li>
                                        <li>Sub Category: <span class="text-brand">{{ $data['subCat']['sub_cat_name'] }}</span></li>
                                    </ul>
                                    <ul class="float-start">
                                        <li class="mb-5">Product Code: <a href="#">{{ $data['product']['product_code'] }}</a></li>
                                        <li class="mb-5">Tags: <a href="#" rel="tag"></a>, <a href="#" rel="tag">{{ $data['product']['product_tags'] }}</a>, <a href="#" rel="tag">Brown</a></li>
                                        <li>Stock:<span class="in-stock text-brand ml-5">{{ $data['product']['product_qtu'] }} Items In Stock</span></li>
                                        <input type="hidden" id="dvendor_id">
                                    </ul>
                                </div>
                                    <div id="social-links">
                                        <ul>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="social-button " id=""><span class="fa fa-facebook-official"></span></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ url()->current() }}" class="social-button " id=""><span class="fa fa-twitter"></span></a></li>
                                            <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url()->current() }}&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><span class="fa fa-linkedin"></span></a></li>
                                            <li><a href="https://wa.me/?text={{ url()->current() }}" class="social-button " id=""><span class="fa fa-whatsapp"></span></a></li>
                                        </ul>
                                    </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{ count($data['review']) }})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    {!! $data['product']['long_desc'] !!}}
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                        <tr class="stand-up">
                                            <th>Stand Up</th>
                                            <td>
                                                <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-wo-wheels">
                                            <th>Folded (w/o wheels)</th>
                                            <td>
                                                <p>32.5″L x 18.5″W x 16.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-w-wheels">
                                            <th>Folded (w/ wheels)</th>
                                            <td>
                                                <p>32.5″L x 24″W x 18.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="door-pass-through">
                                            <th>Door Pass Through</th>
                                            <td>
                                                <p>24</p>
                                            </td>
                                        </tr>
                                        <tr class="frame">
                                            <th>Frame</th>
                                            <td>
                                                <p>Aluminum</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-wo-wheels">
                                            <th>Weight (w/o wheels)</th>
                                            <td>
                                                <p>20 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-capacity">
                                            <th>Weight Capacity</th>
                                            <td>
                                                <p>60 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="width">
                                            <th>Width</th>
                                            <td>
                                                <p>24″</p>
                                            </td>
                                        </tr>
                                        <tr class="handle-height-ground-to-handle">
                                            <th>Handle height (ground to handle)</th>
                                            <td>
                                                <p>37-45″</p>
                                            </td>
                                        </tr>
                                        <tr class="wheels">
                                            <th>Wheels</th>
                                            <td>
                                                <p>12″ air / wide track slick tread</p>
                                            </td>
                                        </tr>
                                        <tr class="seat-back-height">
                                            <th>Seat back height</th>
                                            <td>
                                                <p>21.5″</p>
                                            </td>
                                        </tr>
                                        <tr class="head-room-inside-canopy">
                                            <th>Head room (inside canopy)</th>
                                            <td>
                                                <p>25″</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_color">
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Red, White</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_size">
                                            <th>Size</th>
                                            <td>
                                                <p>M, S</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="Vendor-info">
                                    <div class="vendor-logo d-flex mb-30">
                                        <img src="{{ asset($data['vendor']['photo']) }}" alt="" />
                                        <div class="vendor-name ml-15">
                                            @if($data['vendor']['name'] !== NULL)
                                                <h6>
                                                    <a href="#">{{ $data['vendor']['name'] }}</a>
                                                </h6>
                                            @else
                                                <h5>Sold By <a href="#"><span class="text-danger">Owner</span></a></h5>
                                            @endif

                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">{{ count($data['review']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="contact-infor mb-50">
                                        <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{ $data['vendor']['address'] }}</span></li>
                                        <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>{{ $data['vendor']['phone'] }}</span></li>
                                    </ul>
                                    <p>{{ $data['vendor']['vendor_info'] }}</p>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">

                                                    @foreach($data['review'] as $item)
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset($item->user->photo) }}" alt="user image" />
                                                                <a href="#" class="font-heading text-brand">{{ $item->user->name }}</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">{{ $item->create_at }} </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        @if($item->rating == '5')
                                                                        <div class="product-rating" style="width: 100%"></div>
                                                                        @elseif($item->rating == '4')
                                                                            <div class="product-rating" style="width: 80%"></div>
                                                                        @elseif($item->rating == '3')
                                                                        <div class="product-rating" style="width: 60%"></div>
                                                                        @elseif($item->rating == '2')
                                                                        <div class="product-rating" style="width: 40%"></div>
                                                                        @else
                                                                            <div class="product-rating" style="width: 20%"></div>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">{{ $item->comment }}<a href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        @guest
                                            <p><b>For add Product Review you must login <a href="{{ route('login') }}">Login Here</a></b></p>
                                            @else

                                                <div class="col-lg-12 col-md-12">
                                                    <form class="form-contact comment_form" action="{{ route('store.review') }}" method="post" id="commentForm">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="col-lg-4 col-md-4">
                                                                <table width="20px!important">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>1 start</th>
                                                                        <th>2 start</th>
                                                                        <th>3 start</th>
                                                                        <th>4 start</th>
                                                                        <th>5 start</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="radio" name="quality" value="1" id="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality" value="2" id="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality" value="3" id="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality" value="4" id="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" checked name="quality" value="5" id="">
                                                                        </td>

                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="row">
                                                            <input type="hidden" name="product_id" value="{{ $data['product']['id'] }}">
                                                            <input type="hidden" name="vendor_id" value="{{ $data['vendor']['id'] }}">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="button button-contactForm">Submit Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                @foreach($data['relatedProduct'] as $item)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="{{asset($item->product_thumbnail)}}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" id="{{ $item->id }}" onclick="productView(this.id)" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addTowishList(this.id)" ><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @php
                                                    $amount = $item->selling_price - $item->discount_price;
                                                    $discount =  ($amount/$item->selling_price) * 100;
                                                @endphp
                                                @if($item->discount_price == NULL)
                                                    <span class="new">New</span>
                                                @else
                                                    <span class="hot">{{ round($discount) }}%</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}" tabindex="0">{{ $item->product_name }}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
