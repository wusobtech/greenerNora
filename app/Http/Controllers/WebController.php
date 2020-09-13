<?php

    namespace App\Http\COntrollers;
    use App\Product;
    use Auth;
    use App\User;
    use App\ProductCategory;

    use Illuminate\Http\Request;

    class WebController extends Controller{

        public function index(){
            $categories = ProductCategory::get();
            $newArrivals = Product::where('type', 'New')->orderBy('id' , 'desc')->get();
            $featuredArrivals = Product::inRandomOrder()->paginate(8);
            return view('welcome', compact('categories', 'newArrivals', 'featuredArrivals'));
        }

        public function shop($id){
            $category_list = ProductCategory::get();
            $categories = ProductCategory::where('id', $id)->get();
            $products = Product::where('category_id', $id)->where('status', 'Active')->orderBy('id' , 'desc')->paginate(8);
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

        public function checkout(){
            $user = Auth::User();
            return view('web.checkout',compact('user'));
        }

        public function cart(){
            return view('web.cart');
        }


        public function product(Request $request, $id = null){
            //$product = Product::where('id', $id)->get();
            $product = Product::where('id', $id)->first();
            $similars = Product::where('category_id' , $product->category_id)->where('id' , '!=' , $product->id)->get();
            return view('web.product', compact('product','similars'));
        }

        public function read_file($path){
            return getFileFromPrivateStorage(decrypt($path));
        }

    }



?>
