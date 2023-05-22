@extends('admin.admin_dashboard');



@section('main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Stock</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product Stock <span class="badge rounded-pill bg-info">{{count($allData)}}</span></li>
                    </ol>
                </nav>
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

