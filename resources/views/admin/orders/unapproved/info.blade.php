@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">GreenerNorah</a></li>
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active">Order Info</li>
                    </ol>
                </div>
                <h5 class="page-title">User Order Info</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Order Information</h4>
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <div>
                                        <input type="text" class="form-control" readonly value="{{$verification->user->name}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ordered Date </label>
                                    <div>
                                        <input type="text" class="form-control" readonly value="{{ date('F j, Y', strtotime($verification->orderdate)) }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Order Reference Number </label>
                                    <div>
                                        <input type="text" class="form-control" readonly value="{{ $verification->ref_no }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Order Payment Method </label>
                                    <div>
                                        <input type="text" class="form-control" readonly value="{{ $verification->payment_method }}">
                                    </div>
                                </div>


                                <form class="form-horizontal" action="{{ route('verify_order_status',$verification) }}" method="post">@csrf
                                    <input type="hidden" required name="status" value="Approved"/>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 mt-3 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Approve</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div> <!-- end col -->
        </div> <!-- end row -->


    </div><!-- container fluid -->
@endsection
