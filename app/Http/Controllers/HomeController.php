<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderItem;
use Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->role == "Admin"){
            return redirect('admin/dashboard');
        }
        $user = Auth::User();
        $orders = OrderItem::whereHas('order' , function($query) use ($user) {
            $query->where('user_id' , $user->id)->where('status' , 0);
        })->get();
        return view('user.dashboard', compact('orders','user'));
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }

    public function order(){
        $user = Auth::User();
        $orders = Order::where('user_id' , $user->id)->get();
        return view('user.dashboard', compact('orders','user'));
    }
}
