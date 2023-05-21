<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('admin')}}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Vendor Panel</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('vendor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if(Auth::user()->status === 'active')

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Manage Product</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.vendor.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                <li> <a href="{{ route('add.vendor.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Manage Order</div>
            </a>
            <ul>
                <li> <a href="{{route('vendor.order')}}"><i class="bx bx-right-arrow-alt"></i>Vendor order</a>
                </li>
                <li> <a href="{{route('vendor.return.order')}}"><i class="bx bx-right-arrow-alt"></i>Return Pending</a>
                </li>
                <li> <a href="{{route('vendor.return.confirm.order')}}"><i class="bx bx-right-arrow-alt"></i>Return Confirm</a>
                </li>
            </ul>
        </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-menu"></i>
                    </div>
                    <div class="menu-title">Manage Review</div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.all.review') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
                    </li>
                </ul>
            </li>
        @endif
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
