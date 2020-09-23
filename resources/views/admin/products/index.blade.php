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
                <h5 class="page-title">Add Product</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Create Product</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-20">
                                    <form class="" enctype="multipart/form-data" method="POST" action="{{ route('submitProduct') }}">{{csrf_field()}}
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" placeholder="" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Type</label>
                                            <select name="type"  id="type" class="form-control">
                                                <option  disabled selected>Select</option>
                                                <option value="New">New</option>
                                                <option value="Featured">Featured</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Quantity</label>
                                            <input type="number" name="quantityonhand" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Weight</label>
                                            <input type="number" name="weight" class="form-control">
                                        </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-20">

                                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                            <label>Select Category </label>
                                            <select name="category_id"  id="category_id" class="form-control">
                                                <option selected disabled>Select</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" id="description"  required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Price</label>
                                            <input type="number" placeholder="" name="price" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Discount</label>
                                            <input type="number" name="discount" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Status </label>
                                            <select name="status"  id="type" class="form-control">
                                                <option  disabled selected>Select</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
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



        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">View Created Brands</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Product Image</th>
                                <th>Product Quantity</th>
                                <th>Product Weight</th>
                                <th>Product Discount</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name}}</td>
                                <td>
                                    @if (!empty($product->image))
                                      <a href="{{ getFileFromStorage($product->getImage() , 'storage') }}" target="_blank" class="btn btn-primary btn-block">Click to View Image</a>
                                    @endif
                                </td>
                                <td>{{ $product->quantityonhand }}</td>
                                <td>{{ $product->weight }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ date('F j, Y g:i a',strtotime($product->created_at)) }}</td>
                                    <div class="fr"><td class="center"><a href="{{ route('editProduct', $product->id) }}" class="btn btn-primary btn-sm"><i class="ti-pencil"></i></a>
                                        <a  href="{{ route('deleteProduct', $product->id )}}" class="btn btn-primary btn-sm"><i class="ti-trash"></i></a></td>
                                    </div>
                            </tr>
                            @endforeach
                            
                            {{ $products->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container fluid -->
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> dd29d9d3bbc9d35b688d4b6c5352f08dce87c25c
