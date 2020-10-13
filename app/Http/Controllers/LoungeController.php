<?php

namespace App\Http\Controllers;

use App\Lounge;
use Illuminate\Http\Request;
use App\ProductCategory;
use DB;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class LoungeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::get();
        $lounges = Lounge::paginate(10);
        return view('admin.lounges.index',compact('categories','lounges'));
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
            'name' => 'required|unique:lounges',
            'category_id' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'discount' => 'nullable',
            'image' => 'required|image',
            'price' => 'required',
            'status' => 'required'
        ]);

        DB::beginTransaction();

        try{
            $featuredImage = $request->file('image');
            $image_filename = time().'.'.$featuredImage->getClientOriginalExtension();
            $image_path = public_path('/LoungeImages');
            $featuredImage->move($image_path,$image_filename);

            $data['image'] = $image_filename;

        }
        catch(\Exception $e){
            DB::rollback();
            dump($e->getMessage());
            toastr()->error('An error has occurred please try again later.');
            return back();
        }

        $form = Lounge::create($data);
        DB::commit();
        toastr()->success('Lounge has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function show(Lounge $lounge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loungeDetails = Lounge::FindorFail($id);
        return view('admin.lounges.edit',compact('loungeDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:lounges',
            'category_id' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'discount' => 'nullable',
            'image' => 'required|image',
            'price' => 'required',
            'status' => 'required'
        ]);

        $image = $request->file('image');
        $lounge = Lounge::findorfail($id);

        if (isset($image)) {
            // $image = $request->file('image');
            // $image_filename = putFileInStorage($image ,$this->productImagePath);
            // deleteFileFromStorage($lounge->getImage());

            $image = $request->file('image');
            $image_filename = time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/LoungeImages'.$lounge->image);
            $image->move($image_path,$image_filename);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

        }else {
            $image_filename = $lounge->image;
        }

        $lounge->name = $request->name;
        $lounge->category_id = $request->category_id;
        $lounge->description = $request->description;
        $lounge->phone = $request->phone;
        $lounge->status = $request->status;
        $lounge->image = $image_filename;
        $lounge->discount = $request->discount;
        $lounge->price = $request->price;
        $lounge->save();

        toastr()->success('Lounge updated successfully!');
        return redirect('admin/lounge');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lounge  $lounge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lounge = Lounge::findOrFail($id);
        // deleteFileFromStorage($product->getImage());
        $image_path = public_path('LoungeImages/'.$lounge->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $lounge->delete();
        toastr()->success('lounge deleted successfully!');
        return redirect('admin/lounge');
    }
}
