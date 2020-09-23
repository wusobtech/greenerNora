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
                <h5 class="page-title">Add Category</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Create Category</h4>

                            <form class="" enctype="multipart/form-data" method="POST" action="{{ route('submitCategory') }}">{{csrf_field()}}
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <div>
                                        <input type="text" name="name" class="form-control" required placeholder="Enter Category Name"/>
                                    </div>
                                </div>
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
        </div> <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">View Created Categories</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{ date('F j, Y g:i a',strtotime($category->created_at)) }}</td>
                                    <div class="fr">
                                        <td class="center">
                                            <a href="{{ route('editCategory', $category->id) }}" class="btn btn-primary btn-sm"><i class="ti-pencil"></i></a>
                                            <button class="btn btn-danger btn-flat btn-sm remove-category" data-id="{{ $category->id }}" data-action="{{ route('deleteCategory',$category->id) }}" onclick="deleteConfirmation({{$category->id}})"> Delete</button>
                                        </td>
                                    </div>
                                </tr>
                                @endforeach
                                {{ $categories->links() }}
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container fluid -->
@endsection

