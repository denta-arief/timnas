<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gentelella Alela!</title>

    <!-- Bootstrap -->
<<<<<<< HEAD
    <link href="{{ secure_url('/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ secure_url('/vendors/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    
    <!-- NProgress -->
    <link href="{{ secure_url('/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ secure_url('/build/css/custom.min.css') }}" rel="stylesheet">

    <link href="{{ secure_url('/build/css/profil.css') }}" rel="stylesheet">
=======
    <link href="{{ secure_asset('/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ secure_asset('/vendors/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    {{-- <script src="https://kit.fontawesome.com/3066ed00b4.js" crossorigin="anonymous"></script> --}}
    
    <!-- NProgress -->
    <link href="{{ secure_asset('/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ secure_asset('/build/css/custom.min.css') }}" rel="stylesheet">
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155

    @yield('style')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        {{-- Pengecualian untuk halaman login --}}
        @if (!Request::is('login'))
        <!-- sidebar dan navbar hanya akan muncul jika bukan halaman login -->
        
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
<<<<<<< HEAD
              <a href="{{ secure_url('/index') }}" class="site_title"><i class="fa fa-paw"></i> <span>TIMNAS !!!</span></a>
=======
              <a href="{{ asset('/index') }}" class="site_title"><i class="fa fa-paw"></i> <span>TIMNAS !!!</span></a>
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
<<<<<<< HEAD
                <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.png') }}" 
                    alt="Profile Picture" 
                    class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
=======
                <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome</span>
                <h2>{{ Auth::user()->name ?? Auth::user()->telegram_username ?? Auth::user()->email }}</h2>
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
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

        @endif

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @if (!Request::is('login'))
          @include('layouts.footer.footer')
        @endif
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
<<<<<<< HEAD
    <script src="{{ secure_url('/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
   <script src="{{ secure_url('/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ secure_url('/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ secure_url('/vendors/nprogress/nprogress.js') }}"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ secure_url('/build/js/custom.min.js') }}"></script>
=======
    <script src="{{ asset('/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
   <script src="{{ asset('/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('/vendors/nprogress/nprogress.js') }}"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/build/js/custom.min.js') }}"></script>
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
    @yield('script')
  </body>
</html>