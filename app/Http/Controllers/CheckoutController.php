<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Product;
use App\Order;
use App\OrderItem;
use App\Cart;
use App\CartItem;
use App\OrdersDetail;
use App\DeliveryAddress;
use App\Country;
use Auth;
use Carbon\Carbon;
use DB;
use App\Payment;
use Paystack;
use Session;


class CheckoutController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countries = Country::get();

        //$address = DeliveryAddress::get();
        //dd($address);
        $user_id = Auth::user()->id;
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        if ($shippingCount > 0) {
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        $reference = $cart->reference;
        $total_amount = 0;
        $type = 0;
        return view('web.checkout',compact('shippingDetails','countries','cart','items','reference','total_amount','type'));
    }

    public function receipt(){
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        $reference = $cart->reference;
        $total_amount = 0;
        return view('web.receipt', compact('cart','items','reference','total_amount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            $address = new DeliveryAddress();
            $address->user_id = Auth::User()->id;
            $address->user_email = Auth::User()->email;
            $address->name = $data['name'];
            $address->country = $data['country'];
            $address->address = $data['address'];
            $address->city = $data['city'];
            $address->state = $data['state'];
            $address->postcode = $data['postcode'];
            $address->phone = $data['phone'];
            // dd($data);
            $address->save();

            toastr()->success('Billing Address has been saved successfully!');
            return redirect()->back();
        }
    }

    public function placeOrder(Request $request){

        request()->validate([
            'type' => 'required|string|max:100',

        ]);
            //Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];
        $user = Auth::User();
        $cart = getUserCart();
        $cartItems = $cart->cartItems;
        //dd($cartItems);
        $all = Cart::where('user_id' , $user->id)->count();
        $delivery = $all * 500;
        $sum = Cart::where('user_id' , $user->id)->sum('total');
        $type = $request->input('type');
        $date = new Carbon;
        if($type == 'COD'){
            DB::beginTransaction();
            $currentorder = Order::where('user_id' , $user->id)->where('status' , 'Pending')->orderby('created_at', 'desc')->first();
            // $carts = Cart::where('user_id' , $user->id)->get();
            //$cartItems = CartItem::where('cart_id' , $cart->id)->first();


            try{
                $order = Order::create([
                    'user_id' => $user->id,
                    'orderdate' => $date,
                    'payment_method' => 'Cash On Delivery',
                    'totalamount' => $cart->total, // $request->input('amount'),
                    'status' => 'Pending',
                    'ref_no' => str_shuffle($pin)
                ]);
                foreach ($cartItems as $item){
                    // copy cart item details to order item
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'discount' => $item->discount,
                    ]);

                    // Reduce product quantity
                    $item->product->quantityonhand - $item->quantity;
                    $item->product->save();
                        // Delete cart item from cart
                    $item->delete();
                }
                DB::commit();
            }
            catch(Exception $e){
                DB::rollback();
                throw $e ;
            }
        }

        if ($type == 'DBT') {
            DB::beginTransaction();
            $currentorder = Order::where('user_id' , $user->id)->where('status' , 'Pending')->orderby('created_at', 'desc')->first();

            try{
                $order = Order::create([
                    'user_id' => $user->id,
                    'orderdate' => $date,
                    'payment_method' => 'Direct Bank Transfer',
                    'totalamount' => $cart->total, // $request->input('amount'),
                    'status' => 'Pending',
                    'ref_no' => str_shuffle($pin)
                ]);
                foreach ($cartItems as $item){
                    // copy cart item details to order item
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'discount' => $item->discount,
                    ]);

                    Session::put('order_id',$order->id);
                    Session::put('ref_no',str_shuffle($pin));
                    Session::put('totalamount',$cart->total);

                    //Code for Order Email
                    $email = Auth::user()->email;
                    $messageData = [
                        'email' => $email,
                        'name' => Auth::user()->name,
                        'order_ref_no' => str_shuffle($pin)
                    ];

                    Mail::send('emails.order', $messageData, function($message) use ($email){
                        $message->from('contact@greenernorahinvestments.com', 'Greenernora-Investments');
                        $message->to($email)->subject('Order Placed - Greenernora-Investments');
                    });

                    return redirect('/receipt');

                    // Reduce product quantity
                    $item->product->quantityonhand - $item->quantity;
                    $item->product->save();
                        // Delete cart item from cart
                    $item->delete();
                }
                DB::commit();
            }
            catch(Exception $e){
                DB::rollback();
                throw $e ;
            }


        }

        if ($type == 'Paystack') {

            return Paystack::getAuthorizationUrl()->redirectNow();
        }
    }



    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if($paymentDetails['data']['status'] == 'success')
        {
            toastr()->success('Payment Done Successfully');
        }else{
            toastr()->error('Payment not Successful');
        }
        $payment= new Payment();
        $payment->price = $paymentDetails['data']['amount'];
        $payment->method = 'Paystack';
        $payment->reference= $paymentDetails['data']['reference'];
        // $payment->save();

            //Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];
        $user = Auth::User();
        $cart = getUserCart();
        $cartItems = $cart->cartItems;
        //dd($cartItems);
        $all = Cart::where('user_id' , $user->id)->count();
        $delivery = $all * 500;
        $sum = Cart::where('user_id' , $user->id)->sum('total');
        $type = $request->input('type');
        $date = new Carbon;

            DB::beginTransaction();
            $currentorder = Order::where('user_id' , $user->id)->where('status' , 'Pending')->orderby('created_at', 'desc')->first();
            // $carts = Cart::where('user_id' , $user->id)->get();
            //$cartItems = CartItem::where('cart_id' , $cart->id)->first();


            try{
                $order = Order::create([
                    'payment_id' => $payment->id,
                    'user_id' => $user->id,
                    'orderdate' => $date,
                    'payment_method' => 'Paystack',
                    'totalamount' => $cart->total, // $request->input('amount'),
                    'status' => 'Pending',
                    'ref_no' => str_shuffle($pin)
                ]);
                foreach ($cartItems as $item){
                    // copy cart item details to order item
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'discount' => $item->discount,
                    ]);

                    // Reduce product quantity
                    $item->product->quantityonhand - $item->quantity;
                    $item->product->save();
                        // Delete cart item from cart
                    $item->delete();
                }
                DB::commit();
            }
            catch(Exception $e){
                DB::rollback();
                throw $e ;
            }

        return redirect()
        ->route('home');

        //dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            $data = $request->all();
            DeliveryAddress::where('user_id',$user_id)->update(
                [
                    'name'=>$data['name'],
                    'address'=>$data['address'],
                    'city'=>$data['city'],
                    'state'=>$data['state'],
                    'postcode'=>$data['postcode'],
                    'country'=>$data['country'],
                    'phone'=>$data['phone'],
                ]
            );
            //dd($data);

            toastr()->success('Billing Address has been Updated successfully!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
