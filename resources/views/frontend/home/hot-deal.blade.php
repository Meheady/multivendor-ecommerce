
<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($hotDeal as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                            <img src="{{asset($item->product_thumbnail)}}" alt="" />
                            </a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                @php
                                    $reviewAvg = App\Models\Review::where('product_id', $item->id)->where('status','1')->avg('rating');
                                     @endphp
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
                                <span class="font-small ml-5 text-muted"> ({{ $reviewAvg }})</span>
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
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach($specialOffer as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                    <img src="{{asset($item->product_thumbnail)}}" alt="" />
                                </a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    @php
                                        $reviewAvg = App\Models\Review::where('product_id', $item->id)->where('status','1')->avg('rating');
                                        @endphp
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
                                    <span class="font-small ml-5 text-muted"> ({{ $reviewAvg }})</span>
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
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">
                    @foreach($new as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                    <img src="{{asset($item->product_thumbnail)}}" alt="" />
                                </a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    @php
                                        $reviewAvg = App\Models\Review::where('product_id', $item->id)->where('status','1')->avg('rating');
                                    @endphp

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
                                    <span class="font-small ml-5 text-muted"> ({{ $reviewAvg }})</span>
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
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($specialDeals as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
                                    <img src="{{asset($item->product_thumbnail)}}" alt="" />
                                </a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    @php
                                        $reviewAvg = App\Models\Review::where('product_id', $item->id)->where('status','1')->avg('rating');
                                    @endphp

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
                                    <span class="font-small ml-5 text-muted"> ({{ $reviewAvg }})</span>
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
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
