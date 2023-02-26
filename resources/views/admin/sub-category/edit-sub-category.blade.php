@extends('admin.admin_dashboard');



@section('main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Sub-Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Sub-Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('all.sub.category')}}"  class="btn btn-primary">All Sub-Category</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('update.sub.category',$Data->id)}}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Category</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select name="category" id="" class="form-control">
                                        <option value="" selected disabled >Select Category</option>
                                        @foreach($category as $item)
                                            <option {{ $Data->category_id == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">SubCategory Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $Data->sub_cat_name }}" name="sub_category_name" />

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Update" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
