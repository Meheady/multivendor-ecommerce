@extends('frontend.master')
@section('main')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Checkout</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">

                <div class="row">
                    <h4 class="mb-30">Billing Details</h4>
                    <form method="post" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" required="" value="{{ Auth::user()->username }}" name="username" placeholder="User Name *">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="email" required="" value="{{ Auth::user()->email }}" name="email" placeholder="Email *">
                            </div>
                        </div>



                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select name="division" id="division" class="form-control">
                                        <option value="" selected disabled>Select an Division</option>
                                        @foreach($division as $item)
                                        <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" type="text"  name="postcode" placeholder="Post code">
                            </div>
                        </div>

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select class="form-control" id="district">
                                        <option value="" disabled selected>Select District </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" type="text" value="{{ Auth::user()->phone }}" name="phone" placeholder="Phone *">
                            </div>
                        </div>


                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select id="state" class="form-control">
                                        <option value="" disabled selected>Select State </option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" type="text" value="{{ Auth::user()->address }}" name="address" placeholder="Address *">
                            </div>
                        </div>





                        <div class="form-group mb-30">
                            <textarea rows="5" name="notes" placeholder="Additional information"></textarea>
                        </div>


                </div>
            </div>


            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>

                            @foreach($carts as $item)
                            <tr>
                                <td class="image product-thumbnail"><img src="{{ asset($item->options->image) }}" alt="#"></td>
                                <td>
                                    <h6 class="w-160 mb-5"><a href="#" class="text-heading">{{ $item->name }}</a></h6></span>
                                    <div class="product-rate-cover">

                                        <strong>Color : {{ $item->options->color }}</strong>
                                        <strong>Size : {{ $item->options->size }}</strong>

                                    </div>
                                </td>
                                <td>
                                    <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                </td>
                                <td>
                                    <h4 class="text-brand">${{ $item->price }}</h4>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                        @if(Session::has('coupon'))
                            <table class="table no-border">
                                <tbody>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Subtotal</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${{ $cartTotal }}</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupon Name</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon'] }}</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupon Discount</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${{ session()->get('coupon')['discount_amount'] }}</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${{ session()->get('coupon')['total_amount'] }}</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <table class="table no-border">
                                <tbody>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${{ $cartTotal }}</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
                <div class="payment ml-30">
                    <h4 class="mb-30">Payment</h4>
                    <div class="payment_option">
                        <div class="custome-radio">
                            <input class="form-check-input" value="stripe" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                            <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Sripe</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" value="cash" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" value="online" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                            <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                        </div>
                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="{{ asset('frontend') }}/assets/imgs/theme/icons/payment-paypal.svg" alt="">
                        <img class="mr-15" src="{{ asset('frontend') }}/assets/imgs/theme/icons/payment-visa.svg" alt="">
                        <img class="mr-15" src="{{ asset('frontend') }}/assets/imgs/theme/icons/payment-master.svg" alt="">
                        <img src="{{ asset('frontend') }}/assets/imgs/theme/icons/payment-zapper.svg" alt="">
                    </div>
                    <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                </div>
            </div>
        </div>
    </div>
    </form>


    <script type="text/javascript">
        $('#division').change(function(){
            const id = $(this).val();
            $.ajax({
                url: "{{ url('/ajax-get-district') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function (res) {
                    $('#district').html('<option value="" disabled selected>Select District </option>');
                    $.each(res,function (key,value) {
                        console.log(value)
                        $('#district').append('<option value="'+ value.id +'">'+ value.district_name +'</option>')
                    })
                },
                error: function (e) {
                    console.log(e);
                }
            })
        });

        $('#district').change(function(){
            const id = $(this).val();
            $.ajax({
                url: "{{ url('/ajax-get-state') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function (res) {
                    $('#state').html('<option value="" disabled selected>Select State </option>');
                    $.each(res,function (key,value) {
                        console.log(value)
                        $('#state').append('<option value="'+ value.id +'">'+ value.state_name +'</option>')
                    })
                },
                error: function (e) {
                    console.log(e);
                }
            })
        });
    </script>
@endsection


