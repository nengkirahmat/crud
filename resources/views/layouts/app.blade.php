<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboards</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- third party css -->
    <link href="assets/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="assets/css/app-modern-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
    


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="loading" data-layout="detached"
    data-layout-config='{"leftSidebarCondensed":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Topbar Start -->
    <div class="navbar-custom topnav-navbar topnav-navbar-dark">
        <div class="container-fluid">

            <!-- LOGO -->
            <a href="index.html" class="topnav-logo">
                <span class="topnav-logo-lg">
                    <img src="/" alt="" height="16">
                </span>
                <span class="topnav-logo-sm">
                    <img src="/" alt="" height="16">
                </span>
            </a>

            <ul class="list-unstyled topbar-right-menu float-right mb-0">

            </ul>
            <a class="button-menu-mobile disable-btn">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            
        </div>
    </div>
    <!-- end Topbar -->

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Begin page -->
        <div class="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu left-side-menu-detached">

                <div class="leftbar-user">
                    <a href="javascript: void(0);">
                        <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                            class="rounded-circle shadow-sm">
                        <span class="leftbar-user-name">Dominic Keller</span>
                    </a>
                </div>

                <!--- Sidemenu -->
                <ul class="metismenu side-nav">

                    <li class="side-nav-title side-nav-item">Navigation</li>

                    <li class="side-nav-item">
                        <a href="javascript: void(0);" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <span> Dashboards </span>
                        </a>

                    </li>

                    <li class="side-nav-title side-nav-item">Apps</li>

                    <li class="side-nav-item">
                        <a href="/jurusan" class="side-nav-link">
                            <i class="uil-table"></i>
                            <span> Jurusan </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="/prodi" class="side-nav-link">
                            <i class="uil-table"></i>
                            <span> Program Studi </span>
                        </a>
                    </li>



                </ul>



                <div class="clearfix"></div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <main id="main" style="width: 100%">

                @yield('content')

            </main>

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            2020 © Nengki Rahmad
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right footer-links d-none d-md-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div> <!-- content-page -->

    </div> <!-- end wrapper-->
    </div>
    <!-- END Container -->


    <!-- Right Sidebar -->
    <div class="right-bar">

        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="dripicons-cross noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <div class="rightbar-content h-100" data-simplebar>

            <div class="p-3">
                <div class="alert alert-warning" role="alert">
                    <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                </div>

                <!-- Settings -->
                <h5 class="mt-3">Color Scheme</h5>
                <hr class="mt-1" />

                <div class="custom-control custom-switch mb-1">
                    <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                        id="light-mode-check" checked />
                    <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                </div>

                <div class="custom-control custom-switch mb-1">
                    <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                        id="dark-mode-check" />
                    <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                </div>

                <!-- Left Sidebar-->
                <h5 class="mt-4">Left Sidebar</h5>
                <hr class="mt-1" />

                <div class="custom-control custom-switch mb-1">
                    <input type="radio" class="custom-control-input" name="compact" value="fixed" id="fixed-check"
                        checked />
                    <label class="custom-control-label" for="fixed-check">Scrollable</label>
                </div>

                <div class="custom-control custom-switch mb-1">
                    <input type="radio" class="custom-control-input" name="compact" value="condensed"
                        id="condensed-check" />
                    <label class="custom-control-label" for="condensed-check">Condensed</label>
                </div>

                <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>

                <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
                    class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i> Purchase
                    Now</a>
            </div> <!-- end padding-->

        </div>
    </div>

    <div class="rightbar-overlay"></div>
    <!-- /Right-bar -->




    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

     <!-- third party js -->
     <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
     <script src="assets/js/vendor/dataTables.bootstrap4.js"></script>
     <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
     <script src="assets/js/vendor/responsive.bootstrap4.min.js"></script>
     <script src="assets/js/vendor/dataTables.buttons.min.js"></script>
     <script src="assets/js/vendor/buttons.bootstrap4.min.js"></script>
     <script src="assets/js/vendor/buttons.html5.min.js"></script>
     <script src="assets/js/vendor/buttons.flash.min.js"></script>
     <script src="assets/js/vendor/buttons.print.min.js"></script>
     <script src="assets/js/vendor/dataTables.keyTable.min.js"></script>
     <script src="assets/js/vendor/dataTables.select.min.js"></script>
     <!-- third party js ends -->

       <!-- demo app -->
       <script src="assets/js/pages/demo.datatable-init.js"></script>
       <!-- end demo js-->
</body>

</html>
