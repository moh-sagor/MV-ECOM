@extends('frontend.master')
@section('userFrontEnd')
    @include('frontend.index.slider')
    <!--End hero slider-->
    @include('frontend.index.catslider')
    <!--End category slider-->
    @include('frontend.index.banner')
    <!--End banners-->
    @include('frontend.index.producttab')
    <!--Products Tabs-->
    @include('frontend.index.bestsale')
    <!--End Best Sales-->
    <!-- TV Category -->
    @include('frontend.index.tvcat')
    <!--End TV Category -->
    <!-- Tshirt Category -->

    @include('frontend.index.tshirt')
    <!--End Tshirt Category -->
    <!-- Computer Category -->
    @include('frontend.index.computercat')
    <!--End Computer Category -->
   <!-- Column List  -->
   @include('frontend.index.columnlist')
    <!--End 4 columns-->

    <!--Vendor List -->
    @include('frontend.index.vendor')
    <!--End Vendor List -->


@endsection