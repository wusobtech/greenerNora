<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Country;
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
        $countries = Country::get();
        $user = Auth::User();
        $orders = OrderItem::whereHas('order' , function($query) use ($user) {
            $query->where('user_id' , $user->id)->where('status' , 0);
        })->orderBy('id' , 'desc')->paginate(4);
        return view('user.dashboard', compact('orders','user','countries'));
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }

    public function order(){
        $user = Auth::User();
        $orders = Order::where('user_id' , $user->id)->orderBy('id' , 'desc')->paginate(4);
        return view('user.dashboard', compact('orders','user'));
    }
}
