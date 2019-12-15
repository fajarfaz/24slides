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
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bootstrap/css/login.css')}}">
      <link rel="stylesheet" href="{{ asset('bootstrap/font-awesome/css/font-awesome.min.css') }}">
    <!-- Bootstrap 4 -->
   
     <script src="{{ asset('bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="icon" href="{{ asset('resources/image/icon.ico') }}" type="image/png" sizes="32x32">
    <style type="text/css">
      label{
        font-weight: 600;
        color: #34495e;
      }
      .btn-link{
        font-size: 15px;color: #b95657;font-weight: 600;
      }
    </style>
</head>
<body>

    <div id="app" >
        
<main class="py-4">
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
        <div class="card border-0 shadow my-5" style="  z-index: 2019;">
        <div class="card-body p-5" >
                <img src="resources/image/logo.png" style="width: 200px;"  class="rounded mx-auto d-block">
                <div class="card-header" style="background-color:#fff; "></div>

                <div class="card-body" style="background-image: linear-gradient(#fff, #e9dfff);border-radius: 8px;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email" class="bmd-label-floating">{{ __('Email') }}</label>
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group ">
                            <label for="password" >{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group">                
                                    <label class="container-cek" for="remember">
                                        {{ __('REMEMBER ME') }}
                                   
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                     </label>
                        </div>

                        <div class="form-group" style="margin-bottom: 5px">
                     
                                <button type="submit" class="btn btn-primary"  class="font-weight-light" style="font-weight: 501;">
                                    {{ __('LOGIN') }}
                                </button>
                           
                            </div>
                              <div class="form-group" style="margin-bottom: 0px;text-align: center;">
                                     @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                              </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
  </main>
    </div>
</body>
</html>
