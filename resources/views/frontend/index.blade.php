@extends('frontend.master')
@section('main')

    @include('frontend.home.slider')
    <!--End hero slider-->
    @include('frontend.home.feature-category')
    <!--End category slider-->
    @include('frontend.home.banner')
    <!--End banners-->

    @include('frontend.home.new-product')
    <!--Products Tabs-->
    @include('frontend.home.feature-product')
    <!--End Best Sales-->


    <!-- TV Category -->
    @include('frontend.home.tv-category')
    <!--End TV Category -->

    <!-- Tshirt Category -->
    @include('frontend.home.tshirt-category')
    <!--End Tshirt Category -->

    <!-- Computer Category -->
    @include('frontend.home.computer-category')
    <!--End Computer Category -->

    @include('frontend.home.hot-deal')
    <!--End 4 columns-->

    <!--Vendor List -->
    @include('frontend.home.vendor-list')


    <!--End Vendor List -->
@endsection
