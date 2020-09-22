@extends('web.layouts.app')
@section('title')
Checkout
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('({{ $web_source ?? '' }}/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('updateAddress') }}">{{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                    <label>Full Name *</label>
                                    <input type="text" name="name" value="{{ $shippingDetails->name }}" id="billing_name" class="form-control" required>

                                    <label>Country *</label>
                                    <select id="country" name="country" class="form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->name }}"
                                            @if ($country->name == $shippingDetails->country)
                                            selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <label>Street address *</label>
                                    <input type="text" name="address" value="{{ $shippingDetails->address }}" class="form-control" placeholder="House number and Street name" required>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" name="city" value="{{ $shippingDetails->city }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>State / County *</label>
                                            <input type="text" name="state" value="{{ $shippingDetails->state }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="tel" name="postcode" value="{{ $shippingDetails->postcode }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" name="phone" value="{{ $shippingDetails->phone }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Update Billing Address </span>
                                        <span class="btn-hover-text">Update Billing Address</span>
                                    </button>
                            </form>

                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($items as $item)

                                    <tr class="cartItem_{{ $item->id }}">
                                        <td class="product-col">

                                                <h3 class="product-title">
                                                    <a href="#">{{ $item->product->name }}</a>
                                                </h3><!-- End .product-title -->
                                        </td>

                                        <td class="product-col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->quantity }}</td>


                                        <td class="total-col itemTotal_{{$item->id}}">{{ format_money($item->getPrice() )}}</td>
                                    </tr>
                                    <?php $total_amount = $total_amount + ($item->price*$item->quantity); ?>
                                    @endforeach
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>{{ format_money($total_amount) }}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr>
                                        <td>Shipping:</td>
                                        <td>50% Discount</td>
                                    </tr>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>{{ format_money($total_amount) }}</td>
                                    </tr><!-- End .summary-total -->

                                        </tbody>
                                    </table><!-- End .table table-summary -->

                                    <div class="accordion-summary" id="accordion-payment">
                                        <form name="paymentForm" enctype="multipart/form-data" id="paymentForm" action="{{ route('placeOrder') }}" method="POST">{{ csrf_field() }}
                                            <input type="hidden" name="amount" value="{{ $total_amount * 100 }} ">
                                            <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                                            <input type="hidden" name="currency" value="NGN">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                            <div class="card">
                                                <div class="card-header" id="heading-1">
                                                    <h2 class="card-title">
                                                        <input type="radio" id="DBT" name="type" value="DBT" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                            Direct bank transfer
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-3">
                                                    <h2 class="card-title">
                                                        <input type="radio" name="type" id="COD" value="COD" class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3" />
                                                            Cash on delivery
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                                                    <div class="card-body">Make Payment once goods are delivered.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-4">
                                                    <h2 class="card-title">
                                                        <input type="radio" name="type" id="Paystack" value="Paystack" class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                            Paystack
                                                        </input>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Credit Card Payment System with Paystack.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            </div><!-- End .accordion -->

                                        <button type="submit" onclick="return selectPaymentMethod();" class="btn btn-outline-primary-2 btn-order btn-block">
                                            <span class="btn-text">Place Order</span>
                                            <span class="btn-hover-text">Place Order</span>
                                        </button>
                                    </form>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main>
@endsection
