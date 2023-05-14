@extends('vendor.vendor_dashboard');


@section('vendor-main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Order  <span class="badge rounded-pill bg-info">{{count($allData)}}</span></li>
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
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allData as $data)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $data->order->order_date }}</td>
                                    <td>{{ $data->order->invoice_no }}</td>
                                    <td>${{ $data->order->amount }}</td>
                                    <td>{{ $data->order->payment_method }}</td>
                                    <td>
                                        <span class="badge rounded-pill {{ $data->order->status == 'pending'? 'bg-danger':"bg-success" }}">{{ $data->order->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{route('edit.product',$data->id)}}" class="btn btn-small btn-info">View</a>
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


