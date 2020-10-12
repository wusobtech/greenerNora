@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Latest Registered Users Info</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>  ID</th>
                                <th>  User ID</th>
                                <th> Admin ID </th>
                                <th> Payment ID </th>
                                <th>  Ref Number </th>
                                <th> Payment Method </th>
                                <th> Total Amount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($orders as $order)
                                  <tr>
                                    <td>{{ $order->id }}</td>
                                    <th>  {{ $order->user_id }}</th>
                                    <th> {{ $order->admin_id }} </th>
                                    <th> {{ $order->payment_id }} </th>
                                    <th>  {{ $order->ref_no }} </th>
                                    <th> {{ $order->payment_method }} </th>
                                    <th> {{ $order->totalamount }}</th>
                                    <th>{{ $order->status}}</th>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container fluid -->
@endsection
