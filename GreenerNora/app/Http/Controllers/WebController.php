<?php

    namespace App\Http\COntrollers;

    use Illuminate\Http\Request;

    class WebController extends Controller{

        public function index(){
            return view('welcome');
        }

        public function shop(){
            return view('web.shop');
        }

        public function contactus(){
            return view('web.contactus');
        }

        public function cart(){
            return view('web.cart');
        }

        public function login(){
            return view('auth.login');
        }

        public function product(){
            return view('web.product');
        }

    }

?>
