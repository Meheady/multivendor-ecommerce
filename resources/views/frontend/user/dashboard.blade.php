<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Multi-vendor online market | Register</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/main.css?v=5.3" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />

    <style>
        a#xa31cundpni1684174496011 {
            display: none;
        }
        #search-item{
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #ffffff;
            z-index: 999;
            border-radius: 8px;
            margin-top: 5px;
        }
        .search-style-2 form input {
            background-image: unset!important;
        }
    </style>
</head>

<body>
<!-- Modal -->

<!-- Quick view -->
@include('frontend.includes.quick-view')
<!-- Header  -->
@include('frontend.includes.header')
<!--End header-->

<main class="main pages">
    @yield('user-main')
</main>

@include('frontend.includes.footer')

<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{asset('frontend')}}/assets/imgs/theme/loading.gif" alt="" />
            </div>
        </div>
    </div>
{{--</div>--}}
<!-- Vendor JS-->
    <script src="{{asset('frontend')}}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/slick.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/waypoints.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/wow.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/magnific-popup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/select2.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/counterup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/images-loaded.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/isotope.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/scrollup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.elevatezoom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Template  JS -->
    <script src="{{asset('frontend')}}/assets/js/main.js?v=5.3"></script>
    <script src="{{asset('frontend')}}/assets/js/shop.js?v=5.3"></script>
    <script src="{{asset('frontend')}}/assets/js/script.js"></script>
      <!--Start of Tawk.to Script-->
  <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
          var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
          s1.async=true;
          s1.src='https://embed.tawk.to/64620bdbad80445890ed0041/1h0ffslk2';
          s1.charset='UTF-8';
          s1.setAttribute('crossorigin','*');
          s0.parentNode.insertBefore(s1,s0);
      })();
  </script>
  <!--End of Tawk.to Script-->

    @if(Session::has('success'))
        <script>
            $(document).ready(function(){
                toastr.success('{{Session::get('success')}}');
            });
        </script>
    @endif
    @if(Session::has('warning'))
        <script>
            $(document).ready(function(){
                toastr.success('{{Session::get('warning')}}');
            });
        </script>
    @endif
    @if(Session::has('error'))
        <script>
            $(document).ready(function(){
                toastr.success('{{Session::get('error')}}');
            });
        </script>
@endif


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        function addToCart (){

            const pId = $('#p_id').val()
            const pName = $('#pname').html();
            const pColor = $('#pcolor option:selected').html();
            const pSize = $('#psize option:selected').html();
            const pQty = $('#qty').val();
            const vendorId = $('#vendor_id').val();

            $.ajax({
                url: '/cart/data/store/'+ pId,
                type:'POST',
                dataType: 'json',
                data:{
                    pName:pName,
                    pColor:pColor,
                    pSize:pSize,
                    pQty:pQty,
                    vendorId: vendorId
                },
                success:function(data){
                    $('#closeModal').click();
                    miniCart();

                    const SweetAlert = Swal.mixin({
                        position: 'top-end',
                        toast:true,
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if($.isEmptyObject(data.error)){
                        SweetAlert.fire({
                            type:'success',
                            icon: 'success',
                            title: data.success
                        })
                    }
                    else{
                        SweetAlert.fire({
                            type:'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }

    </script>

    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type:'GET',
                url: '/product/mini/cart',
                dataType:'json',
                success: function(data){

                    $('.cartQty').html(data.cartQty);
                    $('.cartTotal').html(data.cartTotal);
                    var miniCartArea = "";
                    $.each(data.carts,function (key,value) {
                        miniCartArea += `<ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a style="width:50px;height:50px" href="#"><img alt="Nest" src="/${value.options.image}" /></a>
                                        </div>
                                        <div class="shopping-cart-title" style="width:146px;margin:-73px 74px 14px;">
                                            <h4><a href="shop-product-right.html">${value.name}</a></h4>
                                            <h3><span>${ value.qty } × </span>${ value.price }</h3>
                                        </div>
                                        <div class="shopping-cart-delete" style="margin:-85px 1px 0px;">
                                            <a type="submit" id="${value.rowId}" onclick="miniRemoveCart(this.id)"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li> <br>
                                </ul>`
                    })
                    $('.miniCartArea').html(miniCartArea);
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }
        miniCart();

        function miniRemoveCart(id) {
            $.ajax({
                type:'GET',
                url:'/remove/mini-cart/'+id,
                dataType:'json',
                success:function (data) {
                    miniCart();
                    const SweetAlert = Swal.mixin({
                        position: 'top-end',
                        toast:true,
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if($.isEmptyObject(data.error)){
                        SweetAlert.fire({
                            type:'success',
                            icon: 'success',
                            title: data.success
                        })
                    }
                    else{
                        SweetAlert.fire({
                            type:'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                },
                error:function(e){
                    SweetAlert.fire({
                        position: 'top-end',
                        timer: 3000,
                        toast:true,
                        icon: 'error',
                        title: e.message
                    })
                }
            });
        }
    </script>

    <script type="text/javascript">

        function wishList() {

            $.ajax({
                type:'GET',
                dtaType:'json',
                url:'/get-wishlist-data/',
                success: function (data) {

                    $('.wishlistcount').html(data.wishQty);
                    var rows = "";
                    $.each(data.wishlist,function (key,value) {
                        rows += `
                        <tr class="pt-30">
                            <td class="custome-checkbox pl-30">

                            </td>
                            <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thumbnail}" alt="#" /></td>
                            <td class="product-des product-name">
                                <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name}</a></h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                   ${value.product.discount_price == null
                            ?`<h3 class="text-brand">${value.product.selling_price}</h3>`:`<h3 class="text-brand">${value.product.discount_price}</h3>`
                        }

                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                            ${value.product.product_qty > 0
                            ?`<span class="stock-status in-stock mb-0"> In Stock </span>`:`<span class="stock-status out-stock mb-0"> Out Stock </span>`
                        }

                            </td>
                            <td class="text-right" data-title="Cart">
                                <button class="btn btn-sm">Add to cart</button>
                            </td>
                            <td class="action text-center" data-title="Remove">
                                <a type="submit" id="${value.id}" onclick="removeWishlist(this.id)" class="text-body"><i class="fi-rs-trash"></i></a>
                            </td>
                        </tr>
                        `
                    })
                    $('#wishlist').html(rows);
                }
            });
        }
        wishList();


        function removeWishlist(id) {
            $.ajax({
                type:'GET',
                url:'/remove/wishlist/'+id,
                dataType:'json',
                success:function (data) {
                    wishList();
                    const SweetAlert = Swal.mixin({
                        position: 'top-end',
                        toast:true,
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if($.isEmptyObject(data.error)){
                        SweetAlert.fire({
                            type:'success',
                            icon: 'success',
                            title: data.success
                        })
                    }
                    else{
                        SweetAlert.fire({
                            type:'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                },
                error:function(e){
                    SweetAlert.fire({
                        position: 'top-end',
                        timer: 3000,
                        toast:true,
                        icon: 'error',
                        title: e.message
                    })
                }
            });
        }
    </script>
    <script type="text/javascript">

        function compareList() {

            $.ajax({
                type:'GET',
                dtaType:'json',
                url:'/get-compare-data/',
                success: function (data) {

                    console.log(data);
                    $('.comparecount').html(data.compareQty);
                    var rows = "";
                    $.each(data.comparelist,function (key,value) {
                        rows += `
                            <tr class="pr_image">
                            <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
                            <td class="row_img"><img width="300px" height="300px" src="/${value.product.product_thumbnail}" alt="compare-img" /></td>

                        </tr>
                        <tr class="pr_title">
                            <td class="text-muted font-sm fw-600 font-heading">Name</td>
                            <td class="product_name">
                                <h6><a href="shop-product-full.html" class="text-heading">${value.product.product_name}</a></h6>
                            </td>
                        </tr>
                        <tr class="pr_price">
                            <td class="text-muted font-sm fw-600 font-heading">Price</td>
                            <td class="product_price">
                                ${value.product.discount_price == null
                            ?`<h3 class="text-brand">${value.product.selling_price}</h3>`:`<h3 class="text-brand">${value.product.discount_price}</h3>`
                        }
                            </td>

                        </tr>
                        <tr class="pr_rating">
                            <td class="text-muted font-sm fw-600 font-heading">Rating</td>
                            <td>
                                <div class="rating_wrap">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="rating_num">(121)</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="description">
                            <td class="text-muted font-sm fw-600 font-heading">Description</td>
                            <td class="row_text font-xs">
                                <p class="font-sm text-muted"> ${value.product.long_desc}</p>
                            </td>

                        </tr>
                        <tr class="pr_stock">
                            <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                            <td class="row_stock">
                                ${value.product.product_qty > 0
                            ?`<span class="stock-status in-stock mb-0"> In Stock </span>`:`<span class="stock-status out-stock mb-0"> Out Stock </span>`
                        }
                            </td>
                        </tr>

                        <tr class="pr_add_to_cart">
                            <td class="text-muted font-sm fw-600 font-heading">Buy now</td>
                            <td class="row_btn">
                                <button class="btn btn-sm"><i class="fi-rs-shopping-bag mr-5"></i>Add to cart</button>
                            </td>

                        </tr>
                        <tr class="pr_remove text-muted">
                            <td class="text-muted font-md fw-600"></td>
                            <td class="row_remove">
                                <a type="submit" id="${value.product.id}" onclick="removeCompare(this.id)" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                            </td>
                        </tr>
                        `
                    })
                    $('#compare').html(rows);
                }
            });
        }
        compareList();


        function removeCompare(id) {
            $.ajax({
                type:'GET',
                url:'/remove/compare/'+id,
                dataType:'json',
                success:function (data) {
                    compareList();
                    const SweetAlert = Swal.mixin({
                        position: 'top-end',
                        toast:true,
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if($.isEmptyObject(data.error)){
                        SweetAlert.fire({
                            type:'success',
                            icon: 'success',
                            title: data.success
                        })
                    }
                    else{
                        SweetAlert.fire({
                            type:'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                },
                error:function(e){
                    SweetAlert.fire({
                        position: 'top-end',
                        timer: 3000,
                        toast:true,
                        icon: 'error',
                        title: e.message
                    })
                }
            });
        }
    </script>

    <script type="text/javascript">
        function myCart() {
            $.ajax({
                type:'GET',
                url: '/get-my-cart',
                dataType:'json',
                success: function(data){

                    $('.cartQty').html(data.cartQty);
                    $('.grandTotal').html(data.cartTotal);
                    var myCartArea = "";
                    $.each(data.carts,function (key,value) {
                        myCartArea += `<tr class="pt-30">
                            <td class="custome-checkbox pl-30">

                            </td>
                            <td class="image product-thumbnail pt-40"><img src="/${value.options.image}" alt="#"></td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="#">${value.name}</a></h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width:90%">
                                        </div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">${value.price}</h4>
                            </td>
                            <td class="size" data-title="size">
                                   ${value.options.size == null ? `...`: `<h4 class="text-body">${value.options.size}</h4>`}
                            </td>
                            <td class="color" data-title="color">
                                ${value.options.color == null ?
                            `...`: `<h4 class="text-body">${value.options.color} </h4>`
                        }
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink mr-15">
                                    <div class="detail-qty border radius">
                                        <a type="submit" id="${value.rowId}" onclick="cartDec(this.id)" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                                        <a type="submit" id="${value.rowId}" onclick="cartInc(this.id)"  class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-brand"> $${value.subtotal}</h4>
                            </td>
                            <td class="action text-center type="submit" id="${value.rowId}" onclick="removeMyCart(this.id)" data-title="Remove"><a href="#" class="text-body"><i class="fi-rs-trash"></i></a></td>
                        </tr>`
                    })
                    $('#myCart').html(myCartArea);
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }
        myCart();
        function removeMyCart(id) {
            $.ajax({
                type:'GET',
                url:'/remove/my-cart/'+id,
                dataType:'json',
                success:function (data) {
                    couponCalculation();
                    myCart();
                    miniCart();
                    const SweetAlert = Swal.mixin({
                        position: 'top-end',
                        toast:true,
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if($.isEmptyObject(data.error)){
                        SweetAlert.fire({
                            type:'success',
                            icon: 'success',
                            title: data.success
                        })
                    }
                    else{
                        SweetAlert.fire({
                            type:'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                },
                error:function(e){
                    SweetAlert.fire({
                        position: 'top-end',
                        timer: 3000,
                        toast:true,
                        icon: 'error',
                        title: e.message
                    })
                }
            });
        }


        function cartDec(id) {
            $.ajax({
                type:'GET',
                url:'/cart-dec/'+id,
                dataType:'json',
                success:function (data) {
                    couponCalculation();
                    miniCart();
                    myCart();
                }
            });
        }
        function cartInc(id) {
            $.ajax({
                type:'GET',
                url:'/cart-inc/'+id,
                dataType:'json',
                success:function (data) {
                    couponCalculation();
                    miniCart();
                    myCart();
                }
            });
        }
    </script>
@yield('script')
</body>

</html>
