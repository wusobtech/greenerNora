@extends('web.layouts.app')
@section('title')
Thank You
@endsection
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Thank you</a></li>
                {{-- <li class="breadcrumb-item active" aria-current="page"></li> --}}
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">
                <h2 class="mb-5 text-center">Thank You</h2>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card card-dashboard">
                            <div class="card-body">
                                <div id="reference" style="display:none"></div>
                                <h1 style="text-align: center;font-weight: 700;line-height: 2;color:#fff;">
                                    <p id="responseref" style="font-weight: 500;font-size: 1.4rem;color:#2d2d2d;">
                                    </p>
                                </h1>
                                <p class="text-center" id="msgs">you can check your email or dashboard for order details and delivery date <br><br>
                                    <a href="/" class="btn btn-outline-dark-2 mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</main>
@endsection
