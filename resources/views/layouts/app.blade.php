<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gentelella Alela! </title>

    <!-- Bootstrap -->
    <link href="{{ secure_asset('/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ secure_asset('/vendors/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    {{-- <script src="https://kit.fontawesome.com/3066ed00b4.js" crossorigin="anonymous"></script> --}}
    
    <!-- NProgress -->
    <link href="{{ secure_asset('/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ secure_asset('/build/css/custom.min.css') }}" rel="stylesheet">

    @yield('style')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ asset('/index') }}" class="site_title"><i class="fa fa-paw"></i> <span>TIMNAS !!!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome</span>
                <h2>{{ Auth::user()->name ?? Auth::user()->telegram_username ?? Auth::user()->email }}</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('layouts.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            @include('layouts.footer.button')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('layouts.navbar')
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        @include('layouts.footer.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
   <script src="{{ asset('/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('/vendors/nprogress/nprogress.js') }}"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/build/js/custom.min.js') }}"></script>
    @yield('script')
  </body>
</html>
