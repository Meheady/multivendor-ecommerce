@extends('vendor.vendor_dashboard');


@section('vendor-main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order Return</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Confirm Return</li>
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
                                <th>Return Reason</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allData as $data)

                                @if($data->order->return_order == '2')
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $data->order->order_date }}</td>
                                        <td>{{ $data->order->invoice_no }}</td>
                                        <td>${{ $data->order->amount }}</td>
                                        <td>{{ $data->order->payment_method }}</td>
                                        <td>{{ $data->order->return_reason }}</td>
                                        <td>
                                            <span class="badge rounded-pill {{ $data->order->return_order == '2'? 'bg-success':"bg-success" }}">Confirm</span>
                                        </td>
                                        <td>
                                            <a href="{{route('vendor.order.details',$data->order->id)}}" class="btn btn-small btn-info">View</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



