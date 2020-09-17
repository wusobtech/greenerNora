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

        public function cart(){
            return view('web.cart');
        }

        public function product($id){
            $product=Product::where('id', $id)->first();
            $cat = Product::where('id', $id)->first();
            $similars = Product::where('category_id' , $cat->category_id)->where('id' , '!=' , $cat->id)->get();
            return view('web.product', compact('product','similars'));
        }

        public function faq(){
            return view('web.faq');
        }

        public function tandc(){
            return view('web.tandc');
        }

        public function privacypolicy(){
            return view('web.privacypolicy');
        }

        public function read_file($path)
        {
            return getFileFromPrivateStorage(decrypt($path));
        }

        /**
         * Queries the collection and returns result
         *
         * @param  \App\Product  $product
         * @return \Illuminate\Http\Response
         */
        public function search(Request $request)
        {
            $request->validate([
                'q'=>'required|min:3',
            ]);
            $query = $request->input('q');
            $products = product::where('name','like', "%$query%")->where('status', 'Active')
                                ->orWhere('description','like', "%$query%")->paginate(8);
            return view('web.search-results', compact('products',$products));
        }

    }



?>
