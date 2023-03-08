<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('admin')}}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{asset('admin')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
    <link href="{{asset('admin')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{asset('admin')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{asset('admin')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('admin')}}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{asset('admin')}}/assets/js/pace.min.js"></script>
    <link href="{{asset('admin')}}/assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{asset('admin')}}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('admin')}}/assets/css/app.css" rel="stylesheet">
    <link href="{{asset('admin')}}/assets/css/icons.css" rel="stylesheet">
    <link href="{{asset('admin')}}/assets/css/richtext.min.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/header-colors.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.1/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Vendor Dashboard</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
@include('vendor.includes.sidebar')
<!--end sidebar wrapper -->
    <!--start header -->
@include('vendor.includes.header')
<!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        @yield('vendor-main')
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('vendor.includes.footer')
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{asset('admin')}}/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{asset('admin')}}/assets/js/jquery.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{asset('admin')}}/assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('admin')}}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/jquery-knob/excanvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('admin')}}/assets/plugins/input-tags/js/tagsinput.js"></script>
<script src="{{asset('admin')}}/assets/js/jquery.richtext.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.1/sweetalert2.min.js" integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="{{asset('admin')}}/assets/js/index.js"></script>
<!--app JS-->
<script src="{{asset('admin')}}/assets/js/app.js"></script>
<script src="{{asset('admin')}}/assets/js/init.js"></script>

@if(Session::has('success'))
    <script>
        $(document).ready(function(){
            toastr.success('{{Session::get('success')}}');
        });
    </script>
@endif
@if(Session::has('warning'))
    <script>
        $(document).ready(function(){
            toastr.success('{{Session::get('warning')}}');
        });
    </script>
@endif
@if(Session::has('error'))
    <script>
        $(document).ready(function(){
            toastr.success('{{Session::get('error')}}');
        });
    </script>
@endif

<script type="text/javascript">
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    });
</script>
@yield('script')
</body>

</html>
