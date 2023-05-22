
@extends('frontend.master')
@section('userFrontEnd')

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                    <div class="row">
                        <div class="heading_s1">
                            <h2 class="mb-15 mt-15">Please Verify Your Email</h2>
                            <p class="mb-30">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
                        </div>
                        <div class="col-lg-10 col-md-8 d-flex">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <form method="post" action="{{ route('verification.send') }}" >
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up">Resend Verification Email</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                            <div class="ms-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                <div class="">
                                    <button type="submit" class="btn hover-up background-color: #FF0000 !important;">Logout</button>
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection