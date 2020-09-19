
@if (auth('web')->check())
@php
    $item = $item ?? cartHasItem($product->id);
@endphp
    @if(!empty($item))
        <form action="{{ route('cart.remove') }}" method="post" item_id="{{$product->id}}" class="cart_ajax_form cart_form_{{$product->id}}"> @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="quantity" class="quantity_input_{{$product->id}}" value="{{$item_quantity ?? 1}}">
            <input type="hidden" class="product_cart_input_{{$product->id}}" name="product_cart_id" value="{{$item->id}}">
            <button type="submit" class="product_enroll_btn btn cart_btn_{{$product->id}} btn-product btn-cart" title="Remove from cart">
                <span class="spinner-border text-light spinner cart_btn_spinner_{{$product->id}} d-none"></span>
                <span class="cart_btn_text_{{$product->id}}">Remove from cart</span>
            </button>
        </form>
    @else
        <form action="{{ route('cart.add') }}" method="post" item_id="{{$product->id}}" class="cart_ajax_form"> @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="quantity" class="quantity_input_{{$product->id}}" value="{{$item_quantity ?? 1}}">
            <input type="hidden" class="product_cart_input_{{$product->id}}" name="product_cart_id" value="">
            <button type="submit" class="product_enroll_btn btn cart_btn_{{$product->id}} btn-product btn-cart" title="Add To Cart">
                <span class="spinner-border text-light spinner cart_btn_spinner_{{$product->id}} d-none"></span>
                <span class="cart_btn_text_{{$product->id}} ">Add to cart</span>
            </button>
        </form>
    @endif
@endif
