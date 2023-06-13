@extends('frontend.user.dashboard')
@section('user-main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('dashboard')}}"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('user.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('view.return.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Return Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.change.password') }}" ><i class="fi-rs-key mr-10"></i>Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('user.account') }}" ><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li  class="nav-item">
                                            <a onclick="event.preventDefault();
                                                this.closest('form').submit();" class="nav-link" href="{{ route('logout') }}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </form>

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
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
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
        @if($order->status == 'delivered')
            @if($order->return_reason == null )
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <form action="{{ route('return.order',$order->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Return Reason</label>
                        <textarea name="reason" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
            @else
         <h4 class="text-center text-danger">You are already request for return</h4>
            @endif
        @else
        @endif
    </div>
@endsection
