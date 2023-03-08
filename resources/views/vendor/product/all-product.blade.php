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
                        <li class="breadcrumb-item active" aria-current="page">All Product  <span class="badge rounded-pill bg-info">{{count($allData)}}</span></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('add.vendor.product')}}"  class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allData as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img width="50px" height="50px" src="{{ asset($data->product_thumbnail) }}" alt="">
                                    </td>
                                    <td>{{ $data->product_name }}</td>
                                    <td>{{ $data->selling_price }}</td>
                                    <td>{{ $data->product_qty }}</td>
                                    <td>
                                        @if($data->discount_price == NULL)
                                            <span class="badge rounded-pill bg-info">No discount</span>
                                        @else
                                        @php
                                        $amount = $data->selling_price - $data->discount_price;
                                        $discount = ($amount/$data->selling_price)*100;
                                        @endphp
                                            <span class="badge rounded-pill bg-success">{{ round($discount) }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $data->status == 1? 'Active':'Inactive'}}
                                    </td>
                                    <td>
                                        <a href="{{route('edit.vendor.product',$data->id)}}" class="btn btn-small btn-success">Edit</a>
                                        <a href="{{route('delete.vendor.product',$data->id)}}" id="delete" class="delete btn-small btn btn-danger">Del</a>
                                        <a href="{{route('view.vendor.product',$data->id)}}" class="btn btn-small btn-info">View</a>
                                        @if($data->status == 1)
                                        <a href="{{route('status.vendor.product',$data->id)}}" onclick="return confirm('Are you sure change status')" class="btn btn-small btn-danger">Inactive</a>
                                            @else
                                            <a href="{{route('status.vendor.product',$data->id)}}" onclick="return confirm('Are you sure change status')" class="btn btn-small btn-success">Active</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
