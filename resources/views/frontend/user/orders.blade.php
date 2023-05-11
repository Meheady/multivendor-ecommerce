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
    <div class="page-content pt-50 pb-150">
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
                                        <a class="nav-link"  href="#track-orders" ><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#address" ><i class="fi-rs-marker mr-10"></i>My Address</a>
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
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                        <th>Payment</th>
                                                        <th>Invoice</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orders as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->order_date }}</td>
                                                        <td>${{ $item->amount }}</td>
                                                        <td>{{ $item->payment_method }}</td>
                                                        <td>{{ $item->invoice_no }}</td>
                                                        <td>
                                                            @if($item->status == 'pending')
                                                                <span class="badge rounded-pill bg-warning">{{ $item->status }}</span>
                                                            @elseif($item->status == 'confirm')
                                                                <span class="badge rounded-pill bg-info">{{ $item->status }}</span>
                                                            @elseif($item->status == 'processing')
                                                                <span class="badge rounded-pill bg-facebook">{{ $item->status }}</span>
                                                            @elseif($item->status == 'delivered')
                                                                <span class="badge rounded-pill bg-success">{{ $item->status }}</span>

                                                            @endif
                                                        </td>
                                                        <td><a href="{{ route('user.order.details',$item->id) }}" class="btn-small btn btn-success d-block">View</a></td>
                                                        <td><a href="{{ route('user.invoice.download',$item->id) }}" class="btn-small btn btn-Info d-block">Invoice</a></td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
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
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#photo').change(function(e){
                const reader = new FileReader();
                reader.onload = function(e){
                    $('#show-image').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>
@endsection
