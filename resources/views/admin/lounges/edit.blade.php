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
                                        action="{{ route("updateLounge", $loungeDetails->id) }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" value="{{ $loungeDetails->name }}" name="name"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" value="{{ $loungeDetails->image }}" name="image"
                                                class="form-control">
                                        </div>

                                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                            <label>Select Category </label>
                                            <select name="category_id"  id="category_id" class="form-control">
                                                <option selected disabled>Select</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{ $category->id == $loungeDetails->category_id ? "selected" : "" }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="number" value="{{ $loungeDetails->phone }}" placeholder="" name="phone"
                                                class="form-control" placeholder="Phone Number">
                                        </div>

                                        <div class="form-group">
                                            <label>Product Price</label>
                                            <input type="number" value="{{ $loungeDetails->price }}" placeholder="" name="price"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Discount</label>
                                            <input type="number" value="{{ $loungeDetails->discount }}" name="discount"
                                                class="form-control">
                                        </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-20">

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="5" class="form-control ckeditor" id="description"
                                            required>
                                                {!! $loungeDetails->description !!}
                                            </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Product Status </label>
                                        <select name="status" id="type" class="form-control" required>
                                            <option disabled selected>Select</option>
                                            <option value="Active" {{ "Active" == $loungeDetails->status ? "selected" : "" }}>Active</option>
                                            <option value="Inactive" {{ "Inactive" == $loungeDetails->status ? "selected" : "" }}>Inactive</option>
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
