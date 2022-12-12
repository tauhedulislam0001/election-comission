<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', config('app.name', 'Laravel'))">
    <meta name="author" content="">
    @yield('meta')
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

    <title>@yield('title', 'Echolife')</title>
    @include('admin.layouts.common.css')
    @include('sweetalert::alert')

</head>

<body class="hold-transition light-skin sidebar-mini theme-danger fixed sidebar-collapse">

    <div class="wrapper">
        <div id="loader"></div>

        @include('admin.layouts.top_nav')

        @include('admin.layouts.left_sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            @section('page-title')
                                {{-- page name will come here --}}
                            @show
                            <div class="d-inline-block align-items-center">
                                <nav>
                                    <ol class="breadcrumb">
                                        @section('breadcrumbs')
                                            {{-- breadcrumbs will here --}}
                                        @show
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Content Right Sidebar -->

        {{-- @include('layouts.right_sidebar') --}}

        <!-- /.Content Right Sidebar -->

        @include('admin.layouts.footer')

    </div>
    {{-- Js here --}}
    @include('admin.layouts.common.js')
</body>

</html>
