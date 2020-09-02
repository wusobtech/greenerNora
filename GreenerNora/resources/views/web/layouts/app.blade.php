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
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Greener Norah">
    <meta name="application-name" content="Greener Norah">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ $web_source ?? '' }}/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ $web_source ?? '' }}/css/bootstrap.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ $web_source ?? '' }}/css/style.css">
</head>
<body>
    <!-- main content -->
    <!-- header -->
    <div class="main-content" id="home">
        @include('web.includes.header')
    </div>
    @include('web.includes.mobile_menu')
    @include('web.includes.login_register')
    @yield('content')
    @include('web.includes.footer')

    <!-- Plugins JS File -->
    <script src="{{ $web_source ?? '' }}/js/jquery.min.js"></script>
    <script src="{{ $web_source ?? '' }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ $web_source ?? '' }}/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ $web_source ?? '' }}/js/jquery.waypoints.min.js"></script>
    <script src="{{ $web_source ?? '' }}/js/superfish.min.js"></script>
    <script src="{{ $web_source ?? '' }}/js/owl.carousel.min.js"></script>
    <script src="{{ $web_source ?? '' }}/js/bootstrap-input-spinner.js"></script>
    <script src="{{ $web_source ?? '' }}/js/jquery.elevateZoom.min.js"></script>
    <script src="{{ $web_source ?? '' }}/js/jquery.magnific-popup.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ $web_source ?? '' }}/js/main.js"></script>

</body>