@extends('web.layouts.app')
@section('title')
Dashboard
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">My Account<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}">Sign Out</a>
                                </li>
                            </ul>
                        </aside><!-- End .col-lg-3 -->

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <p>Hello(<span class="font-weight-normal text-dark">{{Auth::user()->name}}) 
                                    <br>
                                    From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                    <p>No order has been made yet.</p>
                                    <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                                    
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                            @if (session()->get('success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('success') }}
                                                </div>
                                            @endif
                                            <form method="POST" action="{{route('profile.update')}}" autocomplete="off">
                                               @csrf
                                               @method('PUT')
                                                <h6 class="heading-small text-muted mb-4 text-center">User information</h6>
                        
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group focused">
                                                            <label class="form-control-label" for="current_password">Current password</label>
                                                            <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group focused">
                                                            <label class="form-control-label" for="new_password">New password</label>
                                                            <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group focused">
                                                            <label class="form-control-label" for="confirm_password">Confirm password</label>
                                                            <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <!-- Button -->
                                                <div class="pl-lg-4">
                                                    <div class="row">
                                                        <div class="col text-center">
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                    
                        
                                    </div>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                    <form method="POST" action="{{route('profile.changeprofile')}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label>Full Name<small style="color: red;">*</small></label>
                                            <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label>phone Number <small style="color: red;">*</small></label>
                                                <input type="text" value="{{Auth::user()->phone}}" name="phone" class="form-control" required>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label>State <small style="color: red;">*</small></label>
                                                <input type="text" value="{{Auth::user()->state}}" name="state" class="form-control" required>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label>Address <small style="color: red;">*</small></label>
                                                <input type="text" value="{{Auth::user()->address}}" name="address" class="form-control" required>
                                            </div>
                                        </div><!-- End .row -->

                                        <label>Email address <small style="color: red;">*</small></label>
                                        <input type="email" value="{{Auth::user()->email}}" class="form-control" name="email" required readonly>

                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection