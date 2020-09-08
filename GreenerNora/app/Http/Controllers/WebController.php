<?php

    namespace App\Http\COntrollers;
    use App\Product;
    use App\ProductCategory;

    use Illuminate\Http\Request;

    class WebController extends Controller{

        public function index(){
            $categories = ProductCategory::get();
            $products = Product::paginate(50);
            return view('welcome', compact('categories' , 'products'));
        }

        public function shop($id){
            $category_list = ProductCategory::get();
            $categories = ProductCategory::where('id', $id)->get();
            $products = Product::where('category_id', $id)->get();
            return view('web.shop', compact('products','categories','category_list'));
        }

        public function frozenfoods(){
            return view('web.frozen_foods');
        }
        public function lounge(){
            return view('web.lounge');
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
