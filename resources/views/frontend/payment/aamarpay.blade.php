@extends('frontend.master')
@section('main')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Online payment
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
            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            @if(Session::has('coupon'))
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
                            @else
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
                            @endif
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Cash on delivery</h4>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <form action="{{ route('cash.order') }}" method="post" id="payment-form">
                            @csrf
                            <div class="form-row">

                                <input type="hidden" name="name" value="{{ $data['name'] }}">
                                <input type="hidden" name="email" value="{{ $data['email'] }}">
                                <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                                <input type="hidden" name="postcode" value="{{ $data['postcode'] }}">
                                <input type="hidden" name="division" value="{{ $data['division'] }}">
                                <input type="hidden" name="district" value="{{ $data['district'] }}">
                                <input type="hidden" name="state" value="{{ $data['state'] }}">
                                <input type="hidden" name="address" value="{{ $data['address'] }}">
                                <input type="hidden" name="notes" value="{{ $data['notes'] }}">

                            </div>
                            <br>
                            <button class="btn btn-primary">Submit Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    $('#state').html('<option value="" disabled selected>Select State</option>');
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
