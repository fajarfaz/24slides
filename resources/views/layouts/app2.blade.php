<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '24SLIDES') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/style2.css') }}">
    
  
    <script src="{{ asset('bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="icon" href="{{ asset('resources/image/icon.ico') }}" type="image/png" sizes="32x32">
    <script type="text/javascript">
        $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});
    </script>
</head>
<body onload="myFunction()" style="margin:0;">
  <div id="loader">
    <svg width="200" height="200" viewBox="0 0 100 100">
      <polyline class="line-cornered stroke-still" points="0,0 100,0 100,100" stroke-width="10" fill="none"></polyline>
      <polyline class="line-cornered stroke-still" points="0,0 0,100 100,100" stroke-width="10" fill="none"></polyline>
      <polyline class="line-cornered stroke-animation" points="0,0 100,0 100,100" stroke-width="10" fill="none"></polyline>
      <polyline class="line-cornered stroke-animation" points="0,0 0,100 100,100" stroke-width="10" fill="none"></polyline>
    </svg>
  </div>
<div style="display:none;" id="myDiv" class="animate-bottom">

    <div id="app">

       <nav class="navbar navbar-expand-lg navbar-dark" style="background-image: linear-gradient(360deg,#131728,#030d3c);">
          <a class="navbar-brand" href="{{route('home')}}" style="margin-left: 103px;">
            <img src="{{ asset('resources/image/logo2.png') }}" style="height: 30px;">
          </a>
          <button class="btn btn-light d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-align-justify"></i>
                    </button>         

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" >
              <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Request
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{route('indexk.lembur')}}">Overtime</a>
               
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('indexk.jadwal_off')}}">Schedule Off</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('index.jatah_makan')}}">Food</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('indexk.jadwal')}}">Shift Schedule</a>
              </li>
              
              <li class="nav-item">
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                </form>
               
              </li>
            </ul>
            <a class="btn btn-warning" href="{{ route('logout') }}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();" style="margin-right: 104px;">Log out</a>
          </div>
        </nav>
      

       <div class="container">
            <main class="py-4">
                <!-- Scroll top -->
                <a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>
                @yield('content')
            </main>
            </div>

            </div>
          <div class="card text-center" style="background-color: #222;color:#fff;border-radius: 0px; font-size: 14px;bottom: 0px;border: 0px solid rgba(247, 247, 247, 0.98);">
          <div class="card-header">
          © 2019 Copyright:
        <a href="https://24slides.com" target="_blank"> 24Slides.com </a>
          </div>
         
        </div>
</div>

<script src="{{ asset('bootstrap/js/scroll.js') }}"></script>
</body>
</body>
</html>