<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;

class OrderController extends Controller
{
    public function index(){
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function unapproved_orders(){
        $orders = Order::where('status','Pending')->orderBy('id' , 'desc')->get();
        return view('admin.orders.unapproved.index', compact('orders'));
    }

    public function approved_orders(){
        $approval = Order::where('status', 'Approved')->get();
        return view('admin.orders.approved.index', compact('approval'));
    }

    public function verify_order_info($id)
    {
        $verification = Order::findorfail($id);
        return view('admin.orders.unapproved.info',compact('verification'));
    }

    public function verify_order_status(Request $request, $id)
    {
        $data = $request->validate([
            'status'=> 'required|string',
        ]);
        $data['admin_id'] = auth('web')->user()->id;
        $verification = Order::findorfail($id);
        $verification->update($data);
        toastr()->success('Order '.$data['status'].' successfully!');
        return redirect()->route('unapproved_orders');
    }

}
