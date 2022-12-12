<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', config('app.name', 'Laravel'))">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">
    <title>@yield('title')</title>

    @include('customlayouts.admin.common.css')

    @yield('extra-css')

</head>

<body class="hold-transition light-skin sidebar-mini theme-danger fixed sidebar-collapse">

    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start">
                <a href="#"
                    class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent hover-primary"
                    data-toggle="push-menu" role="button">
                    <i onclick="myFunction(this)" class="fa fa-arrow-right"><span class="path1"></span><span
                            class="path2"></span><span class="path3"></span></i>
                </a>
                <!-- Logo -->
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <!-- logo-->
                    <div class="logo-lg">
                        <span class="light-logo">
                            <h3>Development</h3>
                            {{-- <img class="logo-admin"
                                src="{{ asset('/dashboard/assets/Images/top-nav-logo.png') }}" alt="logo"> --}}
                        </span>
                        <span class="dark-logo">
                            <h3>Development</h3>
                            {{-- <img class="logo-admin" --}}
                                {{-- src="{{ asset('/dashboard/assets/Images/top-nav-logo.png') }}" alt="logo"> --}}
                        </span>
                    </div>
                </a>
            </div>
            @include('customlayouts.admin.top_nav')
            {{-- @include('layouts.admin.flash') --}}
        </header>

        @include('customlayouts.admin.left_sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title">@yield('page-name')</h3>
                            <div class="d-inline-block align-items-center">
                                <nav>
                                    <ol class="breadcrumb">
                                        @yield('breadcrumb')
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Content Right Sidebar -->
        {{-- @include('customlayouts.admin.right_sidebar') --}}
        <!-- /.Content Right Sidebar -->

        {{-- @include('customlayouts.admin.footer') --}}

        @include('customlayouts.admin.control_sidebar')

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->



    <!-- Page Content overlay -->
    {{-- <script src="{{ asset('js/sweetalert2@9.js') }}"></script> --}}
    @include('customlayouts.admin.common.js')
    @yield('script')
    @include('sweetalert::alert')
    <script>

        /***** Setup Ajax CSRF Token start here *****/

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
