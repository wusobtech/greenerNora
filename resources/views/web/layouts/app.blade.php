<!DOCTYPE html>
<html lang="en">


<!-- molla/cart.html  22 Nov 2019 09:55:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') :: Greener Norah</title>
    <meta name="keywords" content="Frozen Foods,Whole Chicken, Frozen Fish">
    <meta name="author" content="wusob-technologies">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $web_source }}/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $web_source }}/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $web_source }}/images/icons/favicon-16x16.png">
    <link rel="manifest" href="{{ $web_source }}/images/icons/site.html">
    <link rel="mask-icon" href="{{ $web_source }}/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="{{ $web_source }}/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Greener Norah">
    <meta name="application-name" content="Greener Norah">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ $web_source }}/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ $web_source }}/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ $web_source }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $web_source }}/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ $web_source }}/css/plugins/magnific-popup/magnific-popup.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ $web_source }}/css/style.css">
    <link rel="stylesheet" href="{{ $web_source }}/css/plugins/nouislider/nouislider.css">
    <link rel="stylesheet" href="{{ $web_source }}/css/demos/demo-11.css">
     <!-- Jquery Toast css -->
     <link href="{{asset('toast')}}/jquery.toast.min.css" rel="stylesheet" type="text/css" />
     @toastr_css
</head>
<body>
    @include('sweet::alert')
    <!-- main content -->
    <!-- header -->
    //@php($categories = App\ProductCategory::get())
    <div class="main-content" id="home">
        @include('web.includes.header')
    </div>
    @include('web.includes.mobile_menu')
    @yield('content')
    @include('web.includes.footer')
    @include('web.includes.scripts')
    @toastr_js
</body>
    @toastr_render
</html>
