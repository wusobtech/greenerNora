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
            'weight' => 'nullable',
            'status' => 'required',
            'image' => 'required|image',
            'type' => 'required',
            'price' => 'required',
            'quantityonhand' => 'required'
        ]);

        DB::beginTransaction();

        try{
            if(!empty($image = $request->file('image'))){
                $data['image'] = putFileInStorage($image ,$this->productImagePath);
            }

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
    public function edit($id)
    {
        $productDetails = Product::FindorFail($id);
        return view('admin.products.edit',compact('productDetails'));
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

        }else {
            $image_filename = $products->image;
        }

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
        deleteFileFromStorage($product->getImage());
        $product->delete();
        toastr()->success('Product deleted successfully!');
        return redirect('admin/products');
    }

}
