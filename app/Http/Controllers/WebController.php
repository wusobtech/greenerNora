<?php

    namespace App\Http\Controllers;
    use App\Product;
    use App\Lounge;
    use Auth;
    use App\User;
    use App\Mail\ContactMessage;
    use Illuminate\Support\Facades\Mail;
    use App\ProductCategory;

    use Illuminate\Http\Request;

    class WebController extends Controller{

        public function index(){
            $categories = ProductCategory::get();
            $newArrivals = Product::where('type', 'New')->orderBy('id' , 'desc')->get();
            $featuredArrivals = Product::inRandomOrder()->paginate(8);
            return view('welcome', compact('categories', 'newArrivals', 'featuredArrivals'));
        }

        // public function shop($id){
        //     $category_list = ProductCategory::get();
        //     $categories = ProductCategory::where('id', $id)->get();
        //     $products = Product::where('category_id', $id)->where('status', 'Active')->orderBy('id' , 'desc')->paginate(8);

        //     return view('web.shop', compact('products','categories','category_list'));
        // }

        public function frozenfoods(){
            $categories = ProductCategory::where('id', 1)->get();
            $products = Product::where('category_id', 1)->where('status', 'Active')->orderBy('id' , 'desc')->paginate(8);
            return view('web.frozen_foods', compact('products','categories'));
        }
        public function lounge(){
            $categories = ProductCategory::where('id', 2)->get();
            $products = Lounge::where('category_id', 2)->where('status', 'Active')->orderBy('id' , 'desc')->paginate(8);
            return view('web.lounge', compact('products','categories'));
        }

        public function contactus(){
            return view('web.contactus');
        }

        public function submitContact(){
            //dd(request()->all());
            $data = request()->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);

            //dd($data);


            $email = 'contact@greenernorahinvestments.com';



            // Send An Email
            Mail::to($email)->send(new ContactMessage($data));
            alert()->success('Your Mail has been sent Succesfully!', 'We will Get back to you shortly!');
            return redirect()->back();

        }

        public function cart(){
            return view('web.cart');
        }

        public function thankyou(){
            return view('web.thankyou');
        }

        public function product($id){
            $product=Product::where('id', $id)->first();
            if ($product->quantityonhand > 0) {
                $stockLevel = "In Stock";
            } else{
                $stockLevel = "Out of Stock";
            }
            $cat = Product::where('id', $id)->first();
            $similars = Product::where('category_id' , $cat->category_id)->where('id' , '!=' , $cat->id)->get();
            return view('web.product', compact('product','similars','stockLevel'));
        }

        public function loungeInfo($id){
            $product=Lounge::where('id', $id)->first();

            $cat = Lounge::where('id', $id)->first();
            $similars = Lounge::where('category_id' , $cat->category_id)->where('id' , '!=' , $cat->id)->get();
            return view('web.lounges', compact('product','similars'));
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
