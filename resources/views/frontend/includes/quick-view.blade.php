<!-- Quick view -->
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeModal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <img src="" id="pimage" alt="product image" />
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <h3 class="title-detail"><a href="#" id="pname" class="text-heading">S</a></h3>
                            <div class="attr-detail attr-size mb-30" id="sizearea">
                            <strong class="mr-10">Size: </strong>
                            <select name="size" class="form-control unicase-form-control" id="psize">
                                <option selected disabled>Choose size</option>

                            </select>
                            </div>
                            <div class="attr-detail attr-size mb-30" id="colorarea">
                            <strong class="mr-10">Color: </strong>
                            <select name="color" class="form-control unicase-form-control" id="pcolor">
                                <option selected disabled>Choose Color</option>

                            </select>
                            </div>

                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand" id="pprice">$</span>
                                    <span>
                                           <span class="old-price font-md ml-15" id="oldprice">$</span>
                                        </span>
                                </div>
                            </div>
                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <input type="hidden" id="p_id" name="p_id">
                                    <button type="submit" onclick="addToCart()" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Brand: <span class="text-brand" id="pbrand"></span></li>
                                            <li class="mb-5">Category:<span class="text-brand" id="pcat"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Product Code: <span id="pcode" class="text-brand"></span></li>
                                            <li class="mb-5">Stock:
                                                <span id="instock" class="badge badge-fill text-brand badge-success"> </span>
                                                <span id="outstock" class="badge badge-fill text-brand badge-danger"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
