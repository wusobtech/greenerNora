<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use DB;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::get();
        $products = Product::paginate(10);
        return view('admin.products.index',compact('categories','products'));
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
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'description' => 'required',
<<<<<<< HEAD
            'weight' => 'required',
            'status' => 'required',
            'image' => 'required|image',
            'discount' => 'required',
=======
            'weight' => 'nullable',
            'status' => 'required',
            'image' => 'required|image',
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c
            'type' => 'required',
            'price' => 'required',
            'quantityonhand' => 'required'
        ]);

        DB::beginTransaction();

        try{
<<<<<<< HEAD
            // if(!empty($request['image'])){
            //     $image = $request->file('image');
            //     $data['image'] = putFileInStorage($image ,$this->productImagePath);
            // }
            $image_image = $request->file('image');
            $image_filename = time().'.'.$image_image->getClientOriginalExtension();
            $image_path = public_path('/Product_images');
            $image_image->move($image_path,$image_filename);

            $data['image'] = $image_filename;
=======
            if(!empty($image = $request->file('image'))){
                $data['image'] = putFileInStorage($image ,$this->productImagePath);
            }
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c

        }
        catch(\Exception $e){
            DB::rollback();
            dump($e->getMessage());
            toastr()->error('An error has occurred please try again later.');
            return back();
        }

        $form = Product::create($data);
        DB::commit();
        toastr()->success('Product has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function edit($id)
    {
        $categories = ProductCategory::get();
        $productDetails = Product::FindorFail($id);
        return view('admin.products.edit',compact('productDetails','categories'));
=======
    public function edit(Product $id)
    {
        $productDetails = Product::FindorFail($id);
        return view('admin.products.edit',compact('productDetails'));
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'description' => 'required',
            'weight' => 'required',
            'status' => 'required',
            'image' => 'nullable|image',
            'type' => 'required',
            'discount' => 'nullable',
            'price' => 'required',
            'quantityonhand' => 'required'
        ]);
        
        $image = $request->file('image');
        $products = Product::findorfail($id);

        if(isset($image)) {
                $image = $request->file('image');
                // $image_filename = putFileInStorage($image ,$this->productImagePath);
                // deleteFileFromStorage($products->getImage());

                $image_filename = time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('Product_images/'.$product->image);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
=======
        $request->validate([
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'description' => 'required',
            'weight' => 'nullable',
            'status' => 'required',
            'image' => 'required|image',
            'type' => 'required',
            'price' => 'required',
            'quantityonhand' => 'required'
        ]);

        $image = $request->file('image');
        $products = Product::findorfail($id);

        if (isset($image)) {
                $image = $request->file('image');
                $image_filename = putFileInStorage($image ,$this->productImagePath);
                deleteFileFromStorage($products->getImage());
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c

        }else {
            $image_filename = $products->image;
        }

<<<<<<< HEAD
        
        $products->update($data);
=======
        $products->name = $request->name;
        $products->category_id = $request->category_id;
        $products->description = $request->description;
        $products->weight = $request->weight;
        $products->status = $request->status;
        $products->image = $image_filename;
        $products->type = $request->type;
        $products->price = $request->price;
        $products->quantityonhand = $request->quantityonhand;
        $products->save();
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c

        toastr()->success('Product updated successfully!');
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
<<<<<<< HEAD
        //deleteFileFromStorage($product->getImage());
        $image_path = public_path('Product_images/'.$product->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
=======
        deleteFileFromStorage($product->getImage());
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c
        $product->delete();
        toastr()->success('Product deleted successfully!');
        return redirect('admin/products');
    }
<<<<<<< HEAD
=======

>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c
}
