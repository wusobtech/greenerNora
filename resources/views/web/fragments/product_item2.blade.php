<div class="col-6 col-md-4 col-lg-3">

    <div class="product product-11 mt-v3 text-center">
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
        <div class="product-action">
            @if (auth('web')->check())
            @if(!empty($item = cartHasItem($product->id)))
                <form action="{{ route('cart.remove') }}" method="post" item_id="{{$product->id}}" class="cart_ajax_form cart_form_{{$product->id}}"> @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" class="product_cart_input_{{$product->id}}" name="product_cart_id" value="{{$item->id}}">
                    <button type="submit" class="product_enroll_btn btn cart_btn_{{$product->id}} btn-product btn-cart" title="Remove from cart">
                        <span class="spinner-border text-light spinner cart_btn_spinner_{{$product->id}} d-none"></span>
                        <span class="cart_btn_text_{{$product->id}}">Remove from cart</span>
                    </button>
                </form>
            @else
                <form action="{{ route('cart.add') }}" method="post" item_id="{{$product->id}}" class="cart_ajax_form"> @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" class="product_cart_input_{{$product->id}}" name="product_cart_id" value="">
                    <button type="submit" class="product_enroll_btn btn cart_btn_{{$product->id}} btn-product btn-cart" title="Add To Cart">
                        <span class="spinner-border text-light spinner cart_btn_spinner_{{$product->id}} d-none"></span>
                        <span class="cart_btn_text_{{$product->id}} ">Add to cart</span>
                    </button>
                </form>
            @endif
        @endif
        </div><!-- End .product-action -->
    </div><!-- End .product -->

</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
