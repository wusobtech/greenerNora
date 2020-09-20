@extends('web.layouts.app')
@section('title')
Cart
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ $web_source ?? '' }}/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
                <div class="cart">
                    @php
                    if($items->count() > 0){
                        $show = true;
                    }
                    else{
                        $show = false;
                    }
                @endphp
                <div class="container {{ $show == true ? '' : 'd-none'}}" id="has_cart_items">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($items as $item)

                                    <tr class="cartItem_{{ $item->id }}">
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="{{ getFileFromStorage($item->product->getImage()) }}" alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="#">{{ $item->product->name }}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">{{ format_money($item->price )}}</td>
                                        <td class="price-col">{{ format_money($item->discount )}}</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">

                                            <form action="{{ route('cart.update_quantity') }}" id="quantity_form_{{$item->product->id}}" method="POST">@csrf
                                            <input  type="number"
                                                    name="quantity"
                                                    id="product_cart_qty"
                                                    cart_item_id="{{ !empty($item) ? $item->id : ''}}"
                                                    item_id="{{$item->product->id}}"
                                                    product-target=".itemTotal_{{$item->id}}"
                                                    class="form-control product_cart_item_quantity_{{$item->product->id}} updateItemProduct"
                                                    value="{{ !empty($item) ? $item->quantity : '1'}}"
                                                    min="1"
                                                    max="10"
                                                    step="1"
                                                    data-decimals="0"
                                                    required>
                                            </form>                                            </div><!-- End .cart-product-quantity -->
                                        </td>
                                        <td class="total-col itemTotal_{{$item->id}}">{{ format_money($item->getPrice() )}}</td>
                                        <td class="remove-col">
                                            <form action="{{ route('cart.remove') }}" method="post" item_id="{{$item->id}}" class="cart_ajax_form cart_form_{{$item->id}} hideItem"> @csrf
                                                <input type="hidden" name="product_id" value="{{$item->id}}">
                                                <input type="hidden" class="product_cart_input_{{$item->id}}" name="product_cart_id" value="{{$item->id}}">
                                                <button type="submit" class="product_enroll_btn btn cart_btn_{{$item->id}} btn-remove" title="Remove from cart">
                                                    <span class="spinner-border text-light spinner cart_btn_spinner_{{$item->id}} d-none"></span>
                                                    <span class="cart_btn_text_{{$item->id}}"><i class="icon-close"></i></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table><!-- End .table table-wishlist -->

                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td id="cart_price">{{ format_money($cart->price )}}</td>
                                        </tr><!-- End .summary-subtotal -->

                                        <tr class="summary-subtotal">
                                            <td>Discount:</td>
                                            <td id="cart_discount">{{ format_money($cart->discount )}}</td>
                                        </tr><!-- End .summary-subtotal -->


                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td id="cart_total">{{ format_money($cart->total )}}</td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            </div><!-- End .summary -->

                            <a href="{{ url()->previous() }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
                <div class="container {{ $show == false ? '' : 'd-none'}}" id="no_cart_item">
                    <div class="text-center row offset-md-2">
                        <div class="col-md-4 ">
                        </div>
                        <div class="col-md-4 p-4 mt-md-5">
                            No item in your cart at the moment!
                            <br>
                            <a href="{{ route('homepage')}}" class="btn btn-outline-primary">Browse Products</a>
                        </div>
                    </div>
                   </div>
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
