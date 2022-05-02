<!doctype html>
<html lang="en">

   @include('admin.includes.head')
    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include("admin.partials.topbar")

            @include("admin.partials.sidebar")

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                        <!-- start page title -->

                        <!-- end page title -->





                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                @include("admin.partials.footer")
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        @include("admin.partials.right-sidebar")

        <!-- JAVASCRIPT -->
        <script src="{{asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- Peity chart-->
        <script src="{{asset('backend/assets/libs/peity/jquery.peity.min.js')}}"></script>

        <!-- Plugin Js-->
        <script src="{{asset('backend/assets/libs/chartist/chartist.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/jquery.sweet-alert.custom.js')}}"></script>
        <script src="{{asset('backend/assets/js/sweetalert.min.js')}}"></script>

        <script src="{{asset('backend/assets/js/pages/dashboard.init.js')}}"></script>
        <!-- Plugin Js-->

        @yield('js')

    </body>

</html>
