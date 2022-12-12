<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>@yield('title')</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('dashboard/admin/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('dashboard/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/admin/css/skin_color.css') }}">

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-4.jpg)">

    <section class="error-page h-p100">
        <div class="container h-p100">
            <div class="row h-p100 align-items-center justify-content-center text-center">
                <div class="col-lg-7 col-md-10 col-12">
                    <div class="rounded30 p-50">
                        <img src="../images/auth-bg/404.jpg" class="max-w-200" alt="" />
                        <h1>403</h1>
                        <h3>
                            @yield('message')
                        </h3>
                        <div class="my-30"><a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Back
                                to dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Vendor JS -->
    <script src="{{ asset('dashboard/admin/js/vendors.min.js') }}"></script>
    <script src="{{ asset('dashboard/admin/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('dashboard/admin/assets/vendor_components/apexcharts-bundle/dist/apexcharts.min.js') }}">
    </script>
    <script src="{{ asset('dashboard/admin/assets/icons/feather-icons/feather.min.js') }}"></script>


</body>

</html>
