<!DOCTYPE html>
<html lang="en">
    @php($user = Auth::User())
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>GreenerNora Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ $admin_source }}/assets/images/favicon.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ $admin_source }}/assets/plugins/morris/morris.css">

        <!-- Plugins css -->
        <link href="{{ $admin_source }}/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="{{ $admin_source }}/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="{{ $admin_source }}/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="{{ $admin_source }}/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ $admin_source }}/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ $admin_source }}/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link href="{{ $admin_source }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{ $admin_source }}/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="{{ $admin_source }}/assets/css/style.css" rel="stylesheet" type="text/css">
        {{--  <link href="toastr.css" rel="stylesheet"/>  --}}
        @toastr_css

    </head>
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <div class="left-side-logo d-block d-lg-none">
                    <div class="text-center">
                        <a href="#" class="logo"><img src="{{ $admin_source }}/assets/images/logo-dark.png" height="20" alt="logo"></a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>

                            <li>
                                <a href="#" class="waves-effect">
                                    <i class="dripicons-meter"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-calendar"></i> <span> Categories List </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">View</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-broadcast"></i> <span> Products List </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">View</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <div class="topbar-left	d-none d-lg-block">
                            <div class="text-center">

                                <a href="#" class="logo"><img src="{{ $admin_source }}/assets/images/logo.png" height="20" alt="logo"></a>
                            </div>
                        </div>

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="{{ $admin_source }}/assets/images/users/user-1.jpg" alt="user" class="rounded-circle">
                                        <b style="color: black">{{ Auth::User()->name }}</b>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><span class="badge badge-success mt-1 float-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>

                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        @yield('content')

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <footer class="footer">
                    Â© 2018 <b>Drixo</b> <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign.</span>
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{ $admin_source }}/assets/js/jquery.min.js"></script>
        <script src="{{ $admin_source }}/assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{ $admin_source }}/assets/js/modernizr.min.js"></script>
        <script src="{{ $admin_source }}/assets/js/detect.js"></script>
        <script src="{{ $admin_source }}/assets/js/fastclick.js"></script>
        <script src="{{ $admin_source }}/assets/js/jquery.slimscroll.js"></script>
        <script src="{{ $admin_source }}/assets/js/jquery.blockUI.js"></script>
        <script src="{{ $admin_source }}/assets/js/waves.js"></script>
        <script src="{{ $admin_source }}/assets/js/jquery.nicescroll.js"></script>
        <script src="{{ $admin_source }}/assets/js/jquery.scrollTo.min.js"></script>

        <!-- skycons -->
        <script src="{{ $admin_source }}/assets/plugins/skycons/skycons.min.js"></script>

        <!-- skycons -->
        <script src="{{ $admin_source }}/assets/plugins/peity/jquery.peity.min.js"></script>

        <!--Morris Chart-->
        <script src="{{ $admin_source }}/assets/plugins/morris/morris.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/raphael/raphael-min.js"></script>

        <!-- dashboard -->
        <script src="{{ $admin_source }}/assets/pages/dashboard.js"></script>

        <!-- Required datatable js -->
        <script src="{{ $admin_source }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="{{ $admin_source }}/assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/jszip.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="{{ $admin_source }}/assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Plugins js -->
        <script src="{{ $admin_source }}/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="{{ $admin_source }}/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

        <!-- Plugins Init js -->
        <script src="{{ $admin_source }}/assets/pages/form-advanced.js"></script>

        <!-- Datatable init js -->
        <script src="{{ $admin_source }}/assets/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="{{ $admin_source }}/assets/js/app.js"></script>

        @toastr_js

    </body>
    @toastr_render
</html>
