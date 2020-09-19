<div class="product product-11 text-center">
    <figure class="product-media">
        <a href="{{ route('product',['id'=>$product->id])}}">
            <img src="{{ getFileFromStorage($product->getImage() , 'storage') }}" alt="Product image" class="product-image">
            <img src="{{ getFileFromStorage($product->getImage() , 'storage') }}" alt="Product image" class="product-image-hover">
        </a>
    </figure><!-- End .product-media -->

    <div class="product-body">
        <h3 class="product-title"><a href="{{ route('product',['id'=>$product->id])}}">{{ $product->name }}</a></h3><!-- End .product-title -->
        <div class="product-price">
            {{ format_money($product->getPrice() )}}
        </div><!-- End .product-price -->
    </div><!-- End .product-body -->
    <div class="product-action text-center">
        @include('web.fragments.cart_actions' , ['product' => $product , 'item_quantity' => 1])

    </div><!-- End .product-action -->
</div><!-- End .product -->
