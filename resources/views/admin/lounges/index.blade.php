@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Greener Norah</a></li>
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active">Lounge</li>
                    </ol>
                </div>
                <h5 class="page-title">Add Lounge</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Create Louunge</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-20">
                                    <form class="" enctype="multipart/form-data" method="POST" action="{{ route('submitLounge') }}">{{csrf_field()}}
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" placeholder="" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Numbeer for Bookings</label>
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>lounge Discount</label>
                                            <input type="number" name="discount" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>lounge Status </label>
                                            <select name="status"  id="type" class="form-control">
                                                <option  disabled selected>Select</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>lounge Price</label>
                                            <input type="number" placeholder="" name="price" class="form-control">
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
                                            <textarea name="description" class="ckeditor form-control" id="description"  required></textarea>
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
                                <th>Lounge Name</th>
                                <th>Category Name</th>
                                <th>Lounge Image</th>
                                <th>Lounge Phone-Number</th>
                                <th>lounge Discount</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($lounges as $lounge)
                            <tr>
                                <td>{{ $lounge->id }}</td>
                                <td>{{ $lounge->name }}</td>
                                <td>{{ $lounge->category->name}}</td>
                                <td>
                                    @if (!empty($lounge->image))
                                      <a href="{{ asset('LoungeImages/'.$lounge->image) }}" target="_blank" class="btn btn-primary btn-block">Click to View Image</a>
                                    @endif
                                </td>
                                <td>{{ $lounge->phone }}</td>
                                <td>{{ $lounge->discount }}</td>
                                <td>{{ date('F j, Y g:i a',strtotime($lounge->created_at)) }}</td>
                                    <div class="fr"><td class="center"><a href="{{ route('editLounge', $lounge->id) }}" class="btn btn-primary btn-sm"><i class="ti-pencil"></i></a>
                                        <a href="{{ route('deleteLounge', $lounge->id) }}" class="btn btn-primary btn-sm"><i class="ti-trash"></i></a></td>
                                    </div>
                            </tr>
                            @endforeach

                            {{ $lounges->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container fluid -->
@endsection
