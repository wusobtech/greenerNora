@extends('web.layouts.app2')
@section('title')
Welcome
@endsection
@section('content')
<main class="main">
            <div class="intro-slider-container mb-4">
                <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "responsive": {
                            "992": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="intro-slide" style="background-image: url({{ $web_source ?? '' }}/images/demos/demo-11/slider/slide-1.jpg);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle text-white">SEASONAL PICKS</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">Get All <br>The Good Stuff</h1><!-- End .intro-title -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url({{ $web_source ?? '' }}/images/demos/demo-11/slider/slide-2.jpg);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle text-white">all at 50% off</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">The Most Beautiful <br>Novelties In Our Shop</h1><!-- End .intro-title -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url({{ $web_source ?? '' }}/images/demos/demo-11/slider/slide-3.jpg);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle text-white">our rooms</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">The Most Elegant <br>for Relaxation</h1><!-- End .intro-title -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
                </div><!-- End .intro-slider owl-carousel owl-simple -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->

            <div class="container">
                <div class="heading heading-center mb-3">
                    <h2 class="title-lg">New Arrivals</h2><!-- End .title -->
                </div><!-- End .heading -->
                <div class="tab-content tab-content-carousel">

                    <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">

                            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                            data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                                @foreach ($newArrivals as $product)
                                    @include('web.fragments.product_item3' , ['product' => $product])
                                @endforeach
                            </div><!-- End .owl-carousel -->


                    </div><!-- .End .tab-pane -->

                </div><!-- End .tab-content -->
            </div><!-- End .container -->

                <div class="container">
                    <div class="heading heading-center mb-6">
                        <h2 class="title">Feature Products</h2><!-- End .title -->
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">

                            <div class="products">

                                <div class="row justify-content-center">
                                    @foreach ($featuredArrivals as $product)
                                        @include('web.fragments.product_item2' , ['product' => $product])
                                    @endforeach
                                </div><!-- End .owl-carousel -->
                            </div><!--End products-->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .container -->
        </main><!-- End .main -->
@endsection
