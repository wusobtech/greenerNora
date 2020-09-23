@extends('web.layouts.app')
@section('title')
Shop
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ $web_source ?? '' }}/images/page-header-bg.jpg')">
            <div class="container">
            <h1 class="page-title">
                    @foreach ($categories as $cat) {{$cat->name}} @endforeach
                <span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
<<<<<<< HEAD
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
=======
                    <div class="col-lg-12">
                        <div class="products mb-3">
                                <div class="row justify-content-center">
                                    @forelse ($products as $product)
                                        @include('web.fragments.product_item' , ['product' => $product])
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
                                </div>
                        </div>
                    </div>
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c
                </div><!-- End .row -->
                <nav aria-label="Page navigation">
                    {{ $products->links() }}
                </nav>
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
