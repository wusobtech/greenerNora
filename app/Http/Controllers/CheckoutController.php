<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\DeliveryAddress;
use App\Country;
use Auth;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::User()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        $reference = $cart->reference;


        return view('web.checkout',compact('userDetails','countries','cart','items','reference'));
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
        $data = $request->validate([
            'user_id' => 'required',
            'user_email' => 'required',
            'description' => 'required',
            'name' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'phone' => 'required'
        ]);

        DB::beginTransaction();

        $form = DeliveryAddress::create($data);
        DB::commit();

        toastr()->success('Billing Address has been saved successfully!');
        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        //
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
