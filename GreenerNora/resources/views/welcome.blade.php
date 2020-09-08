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
                            <h3 class="intro-subtitle text-primary">SEASONAL PICKS</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">Get All <br>The Good Stuff</h1><!-- End .intro-title -->

                            <a href="category.html" class="btn btn-outline-primary-2">
                                <span>DISCOVER MORE</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url({{ $web_source ?? '' }}/images/demos/demo-11/slider/slide-2.jpg);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle text-primary">all at 50% off</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">The Most Beautiful <br>Novelties In Our Shop</h1><!-- End .intro-title -->

                            <a href="category.html" class="btn btn-outline-primary-2 min-width-sm">
                                <span>SHOP NOW</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
                </div><!-- End .intro-slider owl-carousel owl-simple -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->

            <div class="container">
                <div class="toolbox toolbox-filter">
                    <div class="toolbox-left">
                        <a href="#" class="filter-toggler">Filters</a>

                    </div><!-- End .toolbox-left -->
                    <div class="toolbox-right">
                        <ul class="nav-filter product-filter">
                            <li class="active"><a href="#" data-filter="*">All</a></li>
                            <li><a href="#" data-filter=".furniture">Fish</a></li>
                            <li><a href="#" data-filter=".lighting">Poultry</a></li>
                            <li><a href="#" data-filter=".accessories">Accessories</a></li>
                            <li><a href="#" data-filter=".sale">Sale</a></li>
                        </ul>
                    </div><!-- End .toolbox-right -->
                </div><!-- End .filter-toolbox -->

                <div class="widget-filter-area" id="product-filter-area">
                    <a href="#" class="widget-filter-clear">Clean All</a>

                    <div class="filter-area-wrapper">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">
                                        Category:
                                    </h3><!-- End .widget-title -->

                                    <div class="filter-items filter-items-count">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-1">
                                                <label class="custom-control-label" for="cat-1">All</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">24</span>
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-2">
                                                <label class="custom-control-label" for="cat-2">Fish</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">3</span>
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-3">
                                                <label class="custom-control-label" for="cat-3">Poultry</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">2</span>
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget -->
                            </div><!-- End .col-sm-6 col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">
                                        Sort by:
                                    </h3><!-- End .widget-title -->

                                    <div class="filter-items">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" checked id="sort-1" name="sortby">
                                                <label class="custom-control-label" for="sort-1">Bulk</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-2" name="sortby">
                                                <label class="custom-control-label" for="sort-2">Kilo(KG)</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-5" name="sortby">
                                                <label class="custom-control-label" for="sort-5">Price: Low to High</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-6" name="sortby">
                                                <label class="custom-control-label" for="sort-6">Price: High to Low</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget -->
                            </div><!-- End .col-sm-6 col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">
                                        Price:
                                    </h3><!-- End .widget-title -->

                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Price Range:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget -->
                            </div><!-- End .col-sm-6 col-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .filter-area-wrapper -->
                </div><!-- End #product-filter-area.widget-filter-area -->

                <div class="products-container" data-layout="fitRows">

                    @foreach ($products as $product)
                        <div class="product-item furniture col-6 col-md-4 col-lg-3">
                            <div class="product product-4">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="{{ getFileFromStorage($product->getImage()) }}" alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>{{ format_money($product->getPrice() )}}</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">{{ $product->name }}</a></h3><!-- End .product-title -->

                                    <div class="product-action">
                                        @if (auth('web')->check())
                                            @if(!empty($item = cartHasItem($product->id)))
                                                <form action="{{ route('cart.remove') }}" method="post" item_id="{{$product->id}}" class="cart_ajax_form cart_form_{{$product->id}}"> @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" class="product_cart_input_{{$product->id}}" name="product_cart_id" value="{{$item->id}}">
                                                    <button type="submit" class="product_enroll_btn btn cart_btn_{{$product->id}} btn-product btn-cart" title="Remove from cart">
                                                        <span class="spinner-border text-light spinner cart_btn_spinner_{{$product->id}} d-none"></span>
                                                        <span class="cart_btn_text_{{$product->id}}">Remove from cart</span> <i class="icon-long-arrow-right"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('cart.add') }}" method="post" item_id="{{$product->id}}" class="cart_ajax_form"> @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" class="product_cart_input_{{$product->id}}" name="product_cart_id" value="">
                                                    <button type="submit" class="product_enroll_btn btn cart_btn_{{$product->id}} btn-product btn-cart" title="Add To Cart">
                                                        <span class="spinner-border text-light spinner cart_btn_spinner_{{$product->id}} d-none"></span>
                                                        <span class="cart_btn_text_{{$product->id}} ">Add to cart</span><i class="icon-long-arrow-right"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                    </div><!-- End .product-action -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div><!-- End .product-item -->
                    @endforeach

                     <div class="product-item furniture col-6 col-md-4 col-lg-3">
                        <div class="product product-4">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ $web_source ?? '' }}/images/demos/demo-11/products/product-1.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="product.html">Flow Slim Armchair</a></h3><!-- End .product-title -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .product-item -->


                </div><!-- End .products-container -->
            </div><!-- End .container -->

            <div class="more-container text-center mt-0 mb-7">
                <a href="category.html" class="btn btn-outline-dark-3 btn-more"><span>more products</span><i class="la la-refresh"></i></a>
            </div><!-- End .more-container -->
        </main><!-- End .main -->
@endsection
