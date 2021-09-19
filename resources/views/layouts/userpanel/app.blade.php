<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Six Sigma Solution">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="{{ asset('vendors/img/favicon.png')}}">

    <title>{{ config('app.Name', 'Tutorial Point')}}</title>


        <!-- Bootstrap core CSS -->
        <link href="{{ asset('vendors/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/css/bootstrap-reset.css') }}" rel="stylesheet">
        <!--external css-->
        <link href="{{ asset('vendors/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendors/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>
        <link href="{{ asset('vendors/css/owl.carousel.css') }}" type="text/css">

        <!--right slidebar-->
        <link href="{{ asset('vendors/css/slidebars.css') }}" rel="stylesheet">

        <link href="{{ asset('vendors/assets/advanced-datatable/media/css/demo_table.css') }}" rel="stylesheet" />

        <!-- Custom styles for this template -->

        <link href="{{ asset('vendors/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/css/style-responsive.css') }}" rel="stylesheet" />
        <script src="{{ asset('vendors/js/jquery.js') }}"></script>

  </head>

  <body class="light-sidebar-nav">

  <section id="container">
      <!--header start-->
       @include('layouts.userpanel.headerMenu')
      <!--header end-->
      <!--sidebar start-->
       @include('layouts.userpanel.leftMenu')
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
               @yield('content')
          </section>
      </section>
      <!--main content end-->

      <!-- Right Slidebar start -->
      @include('layouts.userpanel.rightMenu')
      <!-- Right Slidebar end -->

      <!--footer start-->
      @include('layouts.userpanel.footer')
      <!--footer end-->
  </section>


      <!-- js placed at the end of the document so the pages load faster -->

      <script src="{{ asset('vendors/js/bootstrap.bundle.min.js') }}"></script>
      <script class="include" type="text/javascript" src="{{ asset('vendors/js/jquery.dcjqaccordion.2.7.js') }}"></script>
      <script src="{{ asset('vendors/js/jquery.scrollTo.min.js') }}"></script>
      <script src="{{ asset('vendors/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
      <script type="text/javascript" src="{{ asset('vendors/assets/advanced-datatable/media/js/jquery.dataTables.js') }}"></script>
      <script src="{{ asset('vendors/js/jquery.sparkline.js') }}" type="text/javascript"></script>
      <script src="{{ asset('vendors/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
      <script src="{{ asset('vendors/js/owl.carousel.js') }}" ></script>
      <script src="{{ asset('vendors/js/jquery.customSelect.min.js') }}" ></script>
      <script src="{{ asset('vendors/js/respond.min.js') }}" ></script>

      <!--right slidebar-->
      <script src="{{ asset('vendors/js/slidebars.min.js') }}"></script>

      <!--common script for all pages-->
      <script src="{{ asset('vendors/js/common-scripts.js') }}"></script>

            <!--dynamic table initialization -->
    <script src="{{ asset('vendors/js/dynamic_table_init.js') }}"></script>
      <!--script for this page-->
      <script src="{{ asset('vendors/js/sparkline-chart.js') }}"></script>
      <script src="{{ asset('vendors/js/easy-pie-chart.js') }}"></script>
      <script src="{{ asset('vendors/js/count.js') }}"></script>

    <script>

        //owl carousel

        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem : true,
                autoPlay:true

            });
        });

        //custom select box

        $(function(){
            $('select.styled').customSelect();
        });

        $(window).on("resize",function(){
            var owl = $("#owl-demo").data("owlCarousel");
            owl.reinit();
        });

    </script>


  </body>
</html>
