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
        <div class="container">
            <p>{{$products->count()}} result(s) for {{request()->input('q')}}</p>
                
            <div class="row">
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
            </div><!-- End .row -->
            <nav aria-label="Page navigation">
                {{ $products->links() }}
            </nav>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
