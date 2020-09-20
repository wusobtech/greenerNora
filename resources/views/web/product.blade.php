@extends('web.layouts.app')
@section('title')
{{$product->name}}
@endsection
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{  url()->previous() }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ getFileFromStorage($product->getImage() , 'storage') }}" data-zoom-image="{{ getFileFromStorage($product->getImage() , 'storage') }}" alt="product image">
                                </figure><!-- End .product-main-image -->

                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details product-details-centered">
                            <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                            </div><!-- End .rating-container -->

                            <div class="product-price">
                                {{ format_money($product->getPrice() )}}
                            </div><!-- End .product-price -->

                            <div class="product-details-action">
                                @if ($product->weight == 0)

                            @else
                                <div class="details-filter-row details-row-size">
                                <label for="size">Weight:</label>
                                <div class="select-custom">
                                    <b>{{$product->weight}}kg</b>
                                </div><!-- End .select-custom -->
                            @endif
                             @auth
                                <div class="details-action-col">
                                    <div class="product-details-quantity">
                                    @php
                                        $item = cartHasItem($product->id)
                                    @endphp
                                    <form action="{{ route('cart.update_quantity') }}" id="quantity_form_{{$product->id}}" method="POST">@csrf
                                    <input  type="number"
                                            name="quantity"
                                            id="product_cart_qty"
                                            cart_item_id="{{ !empty($item) ? $item->id : ''}}"
                                            item_id="{{$product->id}}"
                                            data-target=".quantity_input_{{$product->id}}"
                                            class="form-control product_cart_item_quantity_{{$product->id}}"
                                            value="{{ !empty($item) ? $item->quantity : '1'}}"
                                            min="1"
                                            max="10"
                                            step="1"
                                            data-decimals="0"
                                            required>
                                    </form>
                                    </div><!-- End .product-details-quantity -->

                                    @include('web.fragments.cart_actions' , ['product' => $product ])
                                </div><!-- End .details-action-col -->
                                @else
                                    <div class="text-center">
                                        Login to add to cart
                                    </div>
                                @endauth
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a>{{$product->category->name}}</a>,
                                </div><!-- End .product-cat -->
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Product Information</h3>
                            <p>{{$product->description}} </p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery & returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                            We hope youâ€™ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
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
                @foreach($similars as $similar)
                    <div class="product product-7 text-center">
                        <figure class="product-media">
                            <a href="{{ route('product',['id'=>$similar->id])}}">
                                <img src="{{ getFileFromStorage($similar->getImage() , 'storage') }}" alt="Product image" class="product-image">
                            </a>

                            <div class="product-action">
                                @if (auth('web')->check())
                                @if(!empty($item = cartHasItem($similar->id)))
                                    <form action="{{ route('cart.remove') }}" method="post" item_id="{{$similar->id}}" class="cart_ajax_form cart_form_{{$similar->id}}"> @csrf
                                        <input type="hidden" name="product_id" value="{{$similar->id}}">
                                        <input type="hidden" class="product_cart_input_{{$similar->id}}" name="product_cart_id" value="{{$similar->id}}">
                                        <button type="submit" class="product_enroll_btn btn cart_btn_{{$similar->id}} btn-product btn-cart" title="Remove from cart">
                                            <span class="spinner-border text-light spinner cart_btn_spinner_{{$similar->id}} d-none"></span>
                                            <span class="cart_btn_text_{{$similar->id}}">Remove from cart</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('cart.add') }}" method="post" item_id="{{$similar->id}}" class="cart_ajax_form"> @csrf
                                        <input type="hidden" name="product_id" value="{{$similar->id}}">
                                        <input type="hidden" class="product_cart_input_{{$similar->id}}" name="product_cart_id" value="">
                                        <button type="submit" class="product_enroll_btn btn cart_btn_{{$similar->id}} btn-product btn-cart" title="Add To Cart">
                                            <span class="spinner-border text-light spinner cart_btn_spinner_{{$similar->id}} d-none"></span>
                                            <span class="cart_btn_text_{{$similar->id}} ">Add to cart</span>
                                        </button>
                                    </form>
                                @endif
                            @endif
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a>{{$similar->category->name}}</a>,
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="{{ route('product',['id'=>$similar->id])}}">{{ $similar->name}}</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                {{ format_money($similar->getPrice() )}}
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                @endforeach
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
