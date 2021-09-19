<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>{{ config('app.Name', 'Tutorial Point::Login') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendors/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('vendors/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('vendors/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/css/style-responsive.css') }}" rel="stylesheet" />


</head>

  <body class="login-body">

    <div class="container">

        @yield('loginblock')
      
    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('vendors/js/jquery.js') }}"></script>
    <script src="{{ asset('vendors/js/bootstrap.bundle.min.js') }}"></script>


  </body>

</html>
