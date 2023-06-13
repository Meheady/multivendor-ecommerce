@extends('frontend.user.dashboard')
@section('user-main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
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
                                        <a class="nav-link" href="{{ route('user.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('view.return.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Return Order</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('user.change.password') }}" ><i class="fi-rs-key mr-10"></i>Change Password</a>
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
                                            <h5>Change Password</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('user.change.password') }}" name="enq" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Old Password</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="password" name="oldpass" class="form-control"/>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">New Password</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="password" class="form-control" name="newpass" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Confirm Password</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="password" class="form-control" name="newpass_confirmation" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
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
