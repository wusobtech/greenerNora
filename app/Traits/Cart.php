<?php
namespace App\Traits;

use App\Cart as ModelsCart;
use App\CartItem;
use App\Product;

trait Cart{
    public function addToCart($product_id  = null ,$quantity = 1, $plan_id = null){
        $cart = getUserCart();

        if(!empty($product_id)){
            $product = Product::find($product_id);

            if(empty($product)){
                return ['success' => false, 'msg' => 'Item could not be validated!'];
            }

            if($product->quantityonhand < $quantity){
                return ['success' => false, 'msg' => 'Product is out of stock!'];
            }


            $check = CartItem::where('cart_id' , $cart->id)->where('product_id' , $product->id)->count();
            if($check > 0){
                return ['success' => false, 'msg' => 'Item already exists in cart!'];
            }


            $item = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'discount' => $product->discount ?? 0,
            ]);
            $msg = 'Item added to cart!';

            $product->quantityonhand-=1;
            $product->save();
        }

        $cart = refreshCart($cart->id);

        return [
            'success' => true,
            'msg' => $msg ?? 'Item added to cart',
            'total' => format_money($cart->total),
            'price' => format_money($cart->price),
            'discount' => format_money($cart->discount),
            'quantity' => $cart->items,
            'item_id' => $item->id,
        ];
    }


    public function removeFromCart($item_id){
        $item = Cartitem::find($item_id);
        if(empty($item->id)){
            return ['success' => false, 'msg' => 'Could not remove item from cart!'];
        }

        $cart = ModelsCart::find($item->cart_id);
        $item->delete();
        $cart = refreshCart($cart->id);
        return [
            'success' => true,
            'msg' => 'Item removed from cart',
            'total' => format_money($cart->total),
            'price' => format_money($cart->price),
            'discount' => format_money($cart->total),
            'quantity' => $cart->items,
        ];
    }

    public function updateCartItemQuantity($item_id , $quantity){
        $item = Cartitem::find($item_id);
        if(empty($item->id)){
            return ['success' => false, 'msg' => 'Could not update item in cart!'];
        }

        $cart = ModelsCart::find($item->cart_id);
        $item->quantity = $quantity;
        $item->save();
        $item->total = format_money($item->getPrice() , 0);

        $cart = refreshCart($cart->id);
        return [
            'success' => true,
            'msg' => 'Item quantity updated!',
            'total' => format_money($cart->total),
            'price' => format_money($cart->price),
            'discount' => format_money($cart->discount),
            'quantity' => $cart->items,
            'item' =>  $item,
        ];
    }

}
