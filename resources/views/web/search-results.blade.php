@extends('web.layouts.app')
@section('title')
    Search Results
@endsection
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="search-container container">
           <h4>Search Results</h4>
           <p>{{$products->count()}} result(s) for {{request()->input('q')}}</p>
           <div class="row">
            @forelse ($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product product-3">
                    <figure class="product-media">
                        <span class="product-label">{{$product->type}}</span>
                        <a href="{{ route('product',['id'=>$product->id])}}">
                            <img src="{{ asset('Product_images/'.$product->image) }}" alt="Product image" class="product-image">
                        </a>
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-action">
                            <a href="{{ route('cart.add') }}" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                        <div class="product-cat">
                            <a href="#">{{$product->category->name}}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{ route('product',['id'=>$product->id])}}">{{$product->name}}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                             &#x20a6 {{$product->price}}
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->

                    <div class="product-footer">
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 40%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->
            </div><!-- End .col-sm-6 col-lg-3 -->
            @empty
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product product-3">
                    <div class="product-body">
                        <div class="product-cat">
                            <h2 class="title text-center mb-3">No Products Found</h2><!-- End .title -->
                        </div><!-- End .product-cat -->
                    </div><!-- End .product-body -->

                </div><!-- End .product -->

            </div><!-- End .col-sm-6 col-lg-3 -->
            @endforelse
        </div><!-- End .row -->
        <nav aria-label="Page navigation">
            {{ $products->links() }}
        </nav>
        </div><!-- End Search  .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
