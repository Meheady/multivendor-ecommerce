@extends('admin.admin_dashboard');



@section('main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details  </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Shipping Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Shipping Name: </th>
                                <td>{{ $order->name }}</td>
                            </tr><tr>
                                <th>Shipping Phone: </th>
                                <td>{{ $order->phone }}</td>
                            </tr><tr>
                                <th>Shipping Address: </th>
                                <td>{{ $order->address }}</td>
                            </tr><tr>
                                <th>Shipping Division: </th>
                                <td>{{ $order->division->division_name }}</td>
                            </tr><tr>
                                <th>Shipping District: </th>
                                <td>{{ $order->district->district_name }}</td>
                            </tr>
                            <tr>
                                <th>Shipping State: </th>
                                <td>{{ $order->state->state_name }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Postcode: </th>
                                <td>{{ $order->postcode }}</td>
                            </tr>
                            <tr>
                                <th>Order Date: </th>
                                <td>{{ $order->order_date }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Details </h4>
                        <span class="text-info">{{ $order->invoice_no }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Name: </th>
                                <td>{{ $order->user->name }}</td>
                            </tr><tr>
                                <th>Payment Type: </th>
                                <td>{{ $order->payment_method }}</td>
                            </tr><tr>
                                <th>Txn Id: </th>
                                <td>{{ $order->txn_id }}</td>
                            </tr><tr>
                                <th>Invoice No: </th>
                                <td>{{ $order->invoice_no }}</td>
                            </tr><tr>
                                <th>Amount: </th>
                                <td>${{ $order->amount }}</td>
                            </tr>
                            <tr>
                                <th>Order Status: </th>
                                <td> <span class="badge rounded-pill bg-warning">{{ $order->status }}</span></td>
                            </tr>
                            <tr>
                                <th>Order Date: </th>
                                <td>{{ $order->order_date }}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    @if($order->status == 'pending')
                                    <a href="{{ route('change.status',$order->id) }}" class="confirm btn btn-block btn-success">Confirm Order</a>
                                    @elseif($order->status == 'confirm')
                                        <a href="{{ route('change.status',$order->id) }}" class="confirm btn btn-block btn-success">Processing Order</a>
                                    @elseif($order->status == 'processing')
                                        <a  href="{{ route('change.status',$order->id) }}" class="confirm btn btn-block btn-success">Delivered Order</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td class="col-md-1">
                                <label>Image </label>
                            </td>
                            <td class="col-md-2">
                                <label>Product Name </label>
                            </td>
                            <td class="col-md-2">
                                <label>Vendor Name </label>
                            </td>
                            <td class="col-md-2">
                                <label>Product Code  </label>
                            </td>
                            <td class="col-md-1">
                                <label>Color </label>
                            </td>
                            <td class="col-md-1">
                                <label>Size </label>
                            </td>
                            <td class="col-md-1">
                                <label>Quantity </label>
                            </td>

                            <td class="col-md-3">
                                <label>Price  </label>
                            </td>

                        </tr>


                        @foreach($orderItems as $item)
                            <tr>
                                <td class="col-md-1">
                                    <label><img src="{{ asset($item->product->product_thumbnail) }}" style="width:50px; height:50px;" > </label>
                                </td>
                                <td class="col-md-2">
                                    <label>{{ $item->product->product_name }}</label>
                                </td>
                                @if($item->vendor_id == NULL)
                                    <td class="col-md-2">
                                        <label>Owner </label>
                                    </td>
                                @else
                                    <td class="col-md-2">
                                        <label>{{ $item->product->vendor->name }} </label>
                                    </td>
                                @endif

                                <td class="col-md-2">
                                    <label>{{ $item->product->product_code }} </label>
                                </td>
                                @if($item->color == NULL)
                                    <td class="col-md-1">
                                        <label>.... </label>
                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label>{{ $item->color }} </label>
                                    </td>
                                @endif

                                @if($item->size == NULL)
                                    <td class="col-md-1">
                                        <label>.... </label>
                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label>{{ $item->size }} </label>
                                    </td>
                                @endif
                                <td class="col-md-1">
                                    <label>{{ $item->qty }} </label>
                                </td>

                                <td class="col-md-3">
                                    <label>${{ $item->price }} <br> Total = ${{ $item->price * $item->qty }}   </label>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

