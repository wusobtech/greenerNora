@extends('admin.layout.app')
@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active">Form Validation</li>
                    </ol>
                </div>
                <h5 class="page-title">Edit Product</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Update Product</h4>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <ul class="list-group">
                                    <li class="list-group-item alart alert-danger mb-1">
                                        {{ $error }}
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-20">

                                    <form class="" enctype="multipart/form-data" method="POST"
                                        action="{{ route('updateProduct', $productDetails->id) }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" value="{{ $productDetails->name }}" name="name"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" value="{{ $productDetails->image }}" name="image"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Type</label>
                                            <select name="type" id="type" class="form-control" required>
                                                <option disabled selected>Select</option>
                                                <option value="New"  {{ "New" == $productDetails->type ? "selected" : "" }}>New</option>
                                                <option value="Featured" {{ "Featured" == $productDetails->type ? "selected" : "" }}>Featured</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Quantity</label>
                                            <input type="number" value="{{ $productDetails->quantityonhand }}"
                                                name="quantityonhand" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Weight</label>
                                            <input type="number" value="{{ $productDetails->weight }}" name="weight"
                                                class="form-control">
                                        </div>


                                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                        <label>Select Category </label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option selected disabled>Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                        <div class="form-group">
                                            <label>Product Price</label>
                                            <input type="number" value="{{ $productDetails->price }}" placeholder=""
                                                name="price" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Discount</label>
                                            <input type="number" value="{{ $productDetails->discount }}" name="discount"
                                                class="form-control">
                                        </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-20">

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control ckeditor" id="description" required>
                                                {{ $productDetails->description }}
                                            </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Product Status </label>
                                        <select name="status" id="type" class="form-control" required>
                                            <option disabled selected>Select</option>
                                            <option value="Active" {{ "Active" == $productDetails->status ? "selected" : "" }}>Active</option>
                                            <option value="Inactive" {{ "Inactive" == $productDetails->status ? "selected" : "" }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                            </div> <!-- end col -->

                        </div> <!-- end row -->
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    @endsection
