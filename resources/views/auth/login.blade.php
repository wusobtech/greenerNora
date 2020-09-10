@extends('web.layouts.app')
@section('title')
Login Page
@endsection
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Login</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-color: #fff">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="singin-email-2">Email address *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="singin-password-2">Password *</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="checkbox" onclick="myFunction()">&nbsp;&nbsp;Show Password
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="signin-remember-2" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                        </div><!-- End .custom-checkbox -->

                                        @if (Route::has('password.request'))
                                            <a class="forgot-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="register-email-2">Your Full name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-email-2">Your email address *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-email-2">Your Phone Number *</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-email-2">Your State *</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" required>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-email-2">Your Address *</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-password-2">Password *</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="checkbox" onclick="myFunction2()">&nbsp;&nbsp;Show Password
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-password-2">Confirm Password *</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                        <input type="checkbox" onclick="myFunction1()">&nbsp;&nbsp;Show Password
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                            <label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .container -->
        </div><!-- End .login-page section-bg -->
    </main><!-- End .main -->
@endsection
