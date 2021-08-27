<!doctype html>
<html lang="en">

    
<!-- Mirrored from coderthemes.com/highdmin/vertical/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Apr 2019 06:52:57 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Highdmin - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/') }} backend/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/icons.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/metismenu.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/style.css') }} " rel="stylesheet" type="text/css" />

        <script src="{{ asset('backend/js/modernizr.min.js') }} "></script>

    </head>


    <body class="account-pages">

      @yield('bg')
       

        <div class="wrapper-page account-page-full">

            @yield('content')
            

            @include('include.copyright_dashboard')

        </div>



        <!-- jQuery  -->
        <script src="{{ asset('backend/js/jquery.min.js') }} "></script>
        <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }} "></script>
        <script src="{{ asset('backend/js/metisMenu.min.js') }} "></script>
        <script src="{{ asset('backend/js/waves.js') }} "></script>
        <script src="{{ asset('backend/js/jquery.slimscroll.js') }} "></script>

        <!-- App js -->
        <script src="{{ asset('backend/js/jquery.core.js') }} "></script>
        <script src="{{ asset('backend/js/jquery.app.js') }} "></script>

    </body>

<!-- Mirrored from coderthemes.com/highdmin/vertical/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Apr 2019 06:52:57 GMT -->
</html>