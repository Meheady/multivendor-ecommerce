@extends('admin.admin_dashboard');



@section('main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Coupon</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Coupon</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('create.coupon')}}"  class="btn btn-primary">Add Coupon</a>
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
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Coupon Validity</th>
                                <th>Coupon Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allData as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->coupon_name}}</td>
                                    <td>{{$data->coupon_discount}}</td>
                                    <td>{{Carbon\Carbon::parse($data->coupon_validity)->format('D, d,F,Y')}}</td>
                                    <td>@if ($data->coupon_validity >= \Illuminate\Support\Carbon::now()->format('Y-m-d'))
                                            <span class="badge rounded-pill bg-success">Valid</span>
                                        @else <span class="badge rounded-pill bg-danger">InValid</span>
                                        @endif</td>
                                    <td>
                                        <a href="{{route('edit.coupon',$data->id)}}" class="btn btn-success">Edit</a>
                                        <a href="{{route('delete.coupon',$data->id)}}" id="delete" class="delete btn btn-danger">Delete</a>
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

