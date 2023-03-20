<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Multivendor online market</title>
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
</head>

<body>
<!-- Modal -->

<!-- Quick view -->
@include('frontend.includes.quick-view')
<!-- Header  -->
@include('frontend.includes.header')
<!--End header-->

<main class="main">
    @yield('main')
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
<!-- Template  JS -->
<script src="{{asset('frontend')}}/assets/js/main.js?v=5.3"></script>
<script src="{{asset('frontend')}}/assets/js/shop.js?v=5.3"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
           headers:{
               'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
           }
        });
        function productView(id) {
            $.ajax({
               type:"get",
                url:'product/view/modal/'+id,
                dataType:'json',
                success:function (data){
                    console.log(data);
                    $('#p_id').val(data.product.id)
                   $('#pname').html(data.product.product_name);
                   $('#pcat').html(data.category.cat_name);
                   $('#pbrand').html(data.brand.brand_name);
                   $('#pcode').html(data.product.product_code);
                   $('#pimage').attr('src','/'+data.product.product_thumbnail);

                   if(data.product.discount_price == ''){
                       $('#oldprice').html('');
                       $('#pprice').html(data.product.selling_price);
                   }
                   else{
                       $('#oldprice').html(data.product.selling_price);
                       $('#pprice').html(data.product.discount_price);
                   }
                   if(data.product.product_qty > 0){
                       $('#instock').html('');
                       $('#outstock').html('');
                       $('#instock').html('In Stock');
                   }
                   else{
                       $('#instock').html('');
                       $('#outstock').html('');
                       $('#instock').html('Out Stock');
                   }

                    $('#pcolor').empty();
                   $.each(data.pcolor,function(key,value){
                       $('#pcolor').append('<option value=" + '+value+' ">' +value+'</option>');
                       if (data.pcolor == ''){
                           $('#colorarea').hide();
                       }
                       else{
                           $('#colorarea').show();
                       }
                   })

                    $('#psize').empty();
                    $.each(data.psize,function(key,value){
                       $('#psize').append('<option value=" + '+value+' ">' +value+'</option>');
                        if (data.psize == ''){
                            $('#sizearea').hide();
                        }
                        else{
                            $('#sizearea').show();
                        }
                   })
                },
                error:function(e){
                   console.log(e);
                }

            });
        }

        //end quick view

        function addToCart (){

            const pId = $('#p_id').val()
            const pName = $('#pname').html();
            const pColor = $('#pcolor option:selected').html();
            const pSize = $('#psize option:selected').html();
            const pQty = $('#qty').val();

            $.ajax({
                url: '/cart/data/store/'+ pId,
               type:'POST',
               dataType: 'json',
                data:{
                    pName:pName,
                    pColor:pColor,
                    pSize:pSize,
                    pQty:pQty,
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
        //product details add to cart
        function addToCartPdetails (){

            const pId = $('#d_p_id').val()
            const pName = $('#dpname').html();
            const pColor = $('#dpcolor option:selected').html();
            const pSize = $('#dpsize option:selected').html();
            const pQty = $('#dqty').val();

            $.ajax({
                url: '/dcart/data/store/'+ pId,
                type:'POST',
                dataType: 'json',
                data:{
                    pName:pName,
                    pColor:pColor,
                    pSize:pSize,
                    pQty:pQty,
                },
                success:function(data){
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
        function addTowishList(pid) {

            $.ajax({
               type:'POST',
               dtaType:'json',
               url:'/add-to-wishlist/'+pid,
               success: function (data) {

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
</body>

</html>
