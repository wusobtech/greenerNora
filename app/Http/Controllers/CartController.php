<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Order;
use App\OrderItem;
use App\Traits\Cart as TraitsCart;
use Cart as GlobalCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use TraitsCart;

    // public function __construct()
    // {
    //     $this->middleware = 'auth';
    // }

    public function addProductToCart(Request $request){

        if(empty($request['product_id'])){
            return response()->json(['success' => false, 'msg' => 'Could not validate request!']);
        }

        if(empty($request['quantity'])){
            $request['quantity'] = 1;
        }


        $processCart = $this->addToCart($request['product_id'] , $request['quantity'], $request['plan_id']);
        if($processCart['success']){
            $processCart['type'] = 'add';
            $processCart['msg'] =  $processCart['msg'] ?? 'Item added to cart!';
            $processCart['title'] = 'Remove from cart';
            $processCart['action'] = route('cart.remove');
        }
        return response()->json($processCart);
    }


    public function updateQuantity(Request $request){
        if(empty($request['product_cart_id'])){
            return response()->json(['success' => false, 'msg' => 'Could not validate request!']);
        }
        if(empty($request['quantity'])){
            return response()->json(['success' => false, 'msg' => 'No quantity provided!']);
        }
        $processCart = $this->updateCartItemQuantity($request['product_cart_id'] , $request['quantity']);
        
        return response()->json($processCart);
    }

    public function removeProductFromCart(Request $request){

        if(empty($request['product_cart_id'])){
            return response()->json(['success' => false, 'msg' => 'Could not validate request!']);
        }
        $processCart = $this->removeFromCart($request['product_cart_id']);
        if($processCart['success']){
            $processCart['type'] = 'remove';
            $processCart['msg'] = 'Item removed from cart!';
            $processCart['title'] = 'Add to Cart';
            $processCart['action'] = route('cart.add');
        }
        return response()->json($processCart);
    }

    public function items(){
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        $reference = $cart->reference;
        return view('web.cart', compact('cart', 'items' , 'reference'));
    }

    public function checkout(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'file' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,application/pdf',
            'comment' => 'nullable|string',
            'phone_no' => 'nullable|string',
            'reference' => 'required|string',
        ]);
        if(!empty( $file = $request->file('file'))){
            $data['file'] = putFileInPrivateStorage($file , $this->orderReceiptsFilePath);
        }

        // DB::beginTransaction();
        $cart = getUserCart();
        $data['user_id'] = auth('web')->id();
        $data['amount'] = $cart->total;
        $data['discount'] = $cart->discount;
        $data['reference'] = $cart->reference;
        $data['payment_type'] = 'Bank Transfer';

        $order = Order::create($data);

        foreach($cart->items as $item){
            $amount = 0;
            $discount = 0;
            if(!empty($item->product_id)){
                if(!empty($course = $item->course)){
                    $amount = $course->payableAmount();
                    $discount = $course->discount;
                }
            }
            else{
                if(!empty($plan = $item->plan)){
                    $amount = $plan->price;
                }
            }
            OrderItem::create([
                'order_id' => $order->id,
                'user_id' => auth('web')->id(),
                'product_id' => $item->product_id,
                'plan_id' => $item->plan_id,
                'amount' => $amount,
                'discount' => $discount,
            ]);


            if(!empty($item->product_id)){
                if(!empty($course = $item->course)){
                    $course->orders_count += 1;
                    $course->save();
                }
            }

            $item->delete();
        }

        refreshCart($cart->id , true);
        $return = [
            'msg' => 'Your order has been submitted and is awaiting approval!',
            'reference' => $order->reference,
        ];
        return redirect()->route('cart.checkout.success' , encrypt($return));
    }

    public function checkoutSuccess($data){
        $data = decrypt($data);
        $message = $data['msg'];
        $reference = $data['reference'];
        return view('web.checkout_complete' , compact('message' , 'reference'));
    }

}
