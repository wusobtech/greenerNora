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
                <h5 class="page-title">Update Category</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Update Category</h4>

                            <form method="POST" action="{{ route('updateCategory' , $categoryDetails->id) }}">
                                @csrf
                                {{--  @method('PUT')  --}}
                                <div class="form-group">
                                    <label>Name</label>
                                    <div>
                                        <input type="text" name="name" value="{{ $categoryDetails->name }}" class="form-control" required placeholder="Enter Category Name"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Update
                                        </button>
                                        <a href="/admin/categories" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container fluid -->
@endsection
