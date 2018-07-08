<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Error 500</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Error 500" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-icon.png') }}" type="image/x-icon">

    <!--Basic Styles-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/weather-icons.min.css') }}" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link href="{{ asset('assets/css/beyond.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skins/green.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
    <link id="skin-link" href="#" rel="stylesheet" type="text/css" />
</head>
<!--Head Ends-->
<!--Body-->
<body class="body-500">
    <div class="error-header"> </div>
    <div class="container ">
        <section class="error-container text-center">
            <h1>500</h1>
            <div class="error-divider">
                <h2>ooops!!</h2>
                <p class="description">Anda tidak punya hak akses untuk menuju halaman ini.</p>
            </div>
            <a href="{{ route('home') }}" class="return-btn"><i class="fa fa-home"></i>Beranda</a>
        </section>
    </div>
    <!--Basic Scripts-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!--Beyond Scripts-->
    <script src="{{ asset('assets/js/beyond.js') }}"></script>

    
</body>
</html>
