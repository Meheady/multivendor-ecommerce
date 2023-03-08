@extends('vendor.vendor_dashboard');


@section('vendor-main')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('all.vendor.product')}}"  class="btn btn-primary">All Product</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Product</h5>
                    <hr/>
                    <form action="{{ route('store.vendor.product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Product Title</label>
                                            <input type="text" required name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Tags</label>
                                            <input type="text" required class="form-control visually-hidden" name="product_tags" value="new product,top product" data-role="tagsinput">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Size</label>
                                            <input type="text" required class="form-control visually-hidden" name="product_size" value="small,medium,large,Extra large" data-role="tagsinput">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Color</label>
                                            <input type="text" required class="form-control visually-hidden" name="product_color" value="Red,Blue,Black" data-role="tagsinput">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Short Description</label>
                                            <textarea required name="short_desc" class="form-control" rows="2" placeholder="Enter short Description..."></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Long Description</label>
                                            <textarea required rows="3" class="content" name="long_desc" placeholder="Enter full Description..."></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Thumbnail Image</label>
                                            <input required  id="thumbImg" class="form-control" onchange="mainThumb(this)" name="thumb_img" type="file" accept="image/*">
                                            <img src="" width="70px" height="70px"  id="viewThumb">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Images</label>
                                            <input required id="multiImg" class="form-control" name="multi_img[]" type="file" multiple accept="image/*">
                                            <div class="row" id="multi_img_preview"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputPrice" class="form-label">Product Price</label>
                                                <input type="number" required class="form-control" name="selling_price" id="inputPrice" placeholder="00.00">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="form-label">Discount Price</label>
                                                <input type="number" required name="discount" class="form-control" id="discount" placeholder="00.00">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="form-label">Product Code</label>
                                                <input type="text" required name="product_code" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="form-label">Product Quantity</label>
                                                <input type="number" required name="qty" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="form-label">Product Brand</label>
                                                <select  required name="brand" class="form-select" >
                                                    <option value="" selected disabled>Select Brand</option>
                                                    @foreach($brand as $item)
                                                        <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="form-label">Product Category</label>
                                                <select  required name="category" id="category" class="form-select">
                                                    <option value="" selected disabled>Select Category</option>
                                                    @foreach($category as $item)
                                                        <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="form-label">Product SubCategory</label>
                                                <select  required name="Sub_category" id="subcat" class="form-select" >
                                                    <option value="" selected disabled>Select SubCategory</option>
                                                </select>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hotdeal" type="checkbox" value="1" id="hotdeal">
                                                        <label class="form-check-label" for="hotdeal">Hot Deals</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox" value="1" id="Featured">
                                                        <label class="form-check-label" for="Featured">Featured</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="spoffer" type="checkbox" value="1" id="spoffer">
                                                        <label class="form-check-label" for="spoffer">Special Offer</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="spdeal" type="checkbox" value="1" id="spdeal">
                                                        <label class="form-check-label" for="spdeal">Special Deals</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function mainThumb(input) {
            if (input.files && input.files[0]){
                var render = new FileReader();
                render.onload = function (e) {
                    $('#viewThumb').attr('src',e.target.result).widget(80).height(80);
                }
                render.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>

        $(document).ready(function(){
            $('#multiImg').on('change', function(){ //on file input change

                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                                        .height(80); //create image element
                                    $('#multi_img_preview').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });

            $('#category').change(function(){
                const catId = $(this).val();
                $.ajax({
                    url: "{{ url('/vendor/get-subcategory-by-category') }}/"+catId,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        console.log(data);
                        $('#subcat').html('<option selected disabled>Select SubCategory</option>');
                        const d =  $('#subcat').empty();
                        $.each(data, function(key, value){
                            $('#subcat').append('<option value=" '+ value.id +'">'+ value.sub_cat_name +'</option>')
                        });
                    },
                    error:function(e){
                        console.log(e);
                    }

                })
            });
        });

    </script>
@endsection
