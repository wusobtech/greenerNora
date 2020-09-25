@extends('web.layouts.app')
@section('title')
Thank You
@endsection
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thank You</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    section class="bill-slip">			
    <div class="container">					
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="bill-container">
                    <div class="new-heading">
                        <h1> Thank you so much for you order</h1>
                        <p>I really appreciate it!</p>
                    </div>
                    <div class="discount-text">
                        <p>Enjoy 30% off your next order with coupon code ORDER30. Enjoy!</p>
                        <img src="images/bill-slip/delivery-icon.svg" alt="">
                    </div>
                    <div class="slip-detail">
                        <div class="slip-left">
                            <p>Order To</p>
                        </div>
                        <div class="slip-right">
                            <p>John Doe</p>
                        </div>
                    </div>
                    <div class="slip-detail">
                        <div class="slip-left">
                            <p>Order From</p>
                        </div>
                        <div class="slip-right">
                            <p>Restaurant Name</p>
                        </div>
                    </div>
                    <div class="slip-detail">
                        <div class="slip-left">
                            <p>Meal</p>
                        </div>
                        <div class="slip-right">
                            <p>Toasty Buns Burger</p>
                        </div>
                    </div>
                    <div class="slip-detail">
                        <div class="slip-left">
                            <p>Qty</p>
                        </div>
                        <div class="slip-right">
                            <p>2</p>
                        </div>
                    </div>
                    <div class="slip-detail">
                        <div class="slip-left">
                            <p>Extras</p>
                        </div>
                        <div class="slip-right">
                            <p>Double Cheese</p>
                        </div>
                    </div>
                    <div class="slip-detail">
                        <div class="slip-left">
                            <p>Payment Method</p>
                        </div>
                        <div class="slip-right">
                            <p>Cash on Delivery</p>
                        </div>
                    </div>
                    <div class="vat">
                        <div class="slip-left">
                            <p>VAT</p>
                        </div>
                        <div class="slip-right">
                            <p>1</p>
                        </div>
                    </div>
                    <div class="tolal">
                        <div class="slip-bill-left">
                            <h5>Total</h5>
                        </div>
                        <div class="slip-bill-right">
                            <p>$18</p>
                        </div>
                    </div>
                    <div class="bar-code">
                        <img src="images/bill-slip/qr-icon.svg" alt="">
                    </div>
                    <button class="print-btn">Print Bill</button>
                </div>
            </div>
        </div>							
    </div>
</section>
</main><!-- End .main -->
@endsection

