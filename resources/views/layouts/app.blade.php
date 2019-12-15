<html lang="en" dir="ltr">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/font-awesome/css/font-awesome.min.css') }}">
  
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
    <style type="text/css">
        table{
            font-size: .9em;
        }
        .fa-away{
           position: absolute;
            left: 14px;
            margin-top: 5px;
        }
        p{
            font-size: .9em;
        }
        
    </style>
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

    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editprofil" tabindex="-1" role="dialog" aria-labelledby="editprofil" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editprofilLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('admin.update.admin',auth()->user()->id)}}" id="form-edit" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" name="name" class="form-control" id="name" required="required" value="{{auth()->user()->name}}">
          </div>
          <div class="form-group">
            <label for="emaile" class="col-form-label">Email:</label>            
            <input type="email" name="email" class="form-control" id="email" required="required" value="{{auth()->user()->email}}">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">New Password:</label>            
            <input type="password" name="password" class="form-control" id="password" required="required" >
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Confirm Password:</label>            
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required="required" >
          </div>
          </div>
          <div class="col">
            <div class="form-group">
            <div class="col-sm-10 imgUp center" >
                <label for="photo" >Admin Photo</label>
                <div class="imagePreview" style="height: 228px;"></div>
                <label class="btn btn-primary btn-primary-up">Upload
              <input type="file" name="photo_profile" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                 </label>
              </div>
            </div>
          </div>

            </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-warning" name="submit" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>


 
    <div id="app">
       <!-- Scroll top -->
        <a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>

         <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            
            <div class="sidebar-header">
                <a class="navbar-brand" href="{{ url('/') }}" style="margin-right: 0px;">
                <img src="{{ asset('resources/image/logo2.png') }}" style="height: 60px;border-bottom: 2px solid #d03730;margin: 0px auto;padding-bottom: 4px;">
                </a>
            </div>

            <ul class="list-unstyled components">
                <div class="container-profil">
                <img src="{{ asset('resources/images/photo_profile/'.auth()->user()->photo_profile) }}" class="profile-image">
                 <div class="middle">
                 <div class="text"><button class="btn btn-primary btn-table" data-toggle="modal" data-target="#editprofil" data-whatever=""><i class="fa fa-cog" aria-hidden="true"></i></button></div>
                  </div>
                </div>
                <p class="hi-admin">Hi, Admin <br>(Based On login)</p>
                <li>
                     <a href="{{route('home')}}"><i class="fa-away fa fa-home"></i> Home</a>
            
                </li>
                 <li>
                    <a href="#pageSubmenu6" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa-away fa fa-envelope-o"></i><span class="notif" style="margin: 2px 0px -3px -15px; "></span> Request </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu6">
                        <li>
                            <span class="notif"></span><a href="{{route('index.jadwal_off')}}">Off Schedule</a>
                        </li>                      
                        <li>
                           <span class="notif"></span><a href="#">Print Salary Slip</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('index.karyawan')}}"><i class="fa-away fa fa-user"></i> Employee</a>
                </li>

                  <li>
                    <a href="{{route('index.mutasi')}}"><i class="fa-away fa fa-address-card-o"></i> Mutation</a>
                </li>
                <li>
                    <a href="{{route('importer.jadwal')}}"><i class="fa-away fa fa-calendar"></i> Schedule</a>
                </li>                
               
                 <li>
                    <a href="#pageSubmenu0" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa-away fa fa-money"></i> Base</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu0">
                        <li>
                            <a href="{{route('admin.index.jatah_makan')}}">Food Amount</a>
                        </li>
                        <li>
                            <a href="{{route('index.gaji')}}">Salary Determination</a>
                        </li>
                        <li>
                            <a href="{{route('admin.index.quota')}}">Leave Quota</a>
                        </li>
                    </ul>
                </li>
                  <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa-away fa fa-pencil"></i> Recapitulation</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{route('index.absen')}}">Working Hours</a>
                        </li>
                        <li>
                            <a href="{{route('admin.index.cuti')}}">Leave</a>
                        </li>
                        <li>
                            <a href="{{route('admin.index.izin')}}">Sick Permit</a>
                        </li>
                        <li>
                            <a href="{{route('admin.index.ganti_shift')}}">Change Shift</a>
                        </li>
                        <li>
                            <a href="{{route('index.lembur')}}">Overtime</a>
                        </li>
                        <li>
                            <a href="{{route('index.tambah_gaji')}}">Allowances</a>
                        </li>
                        <li>
                            <a href="{{route('index.kurang_gaji')}}">Deduction</a>
                        </li>
                    </ul>
                </li>            
                <li>
                    <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa-away fa fa-book"></i> Report</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu3">
                        <li>
                            <a href="{{route('admin.report.absen')}}">Punctuality</a>
                        </li>
                        <li>
                            <a href="{{route('admin.report.shift')}}">According to Shift</a>
                        </li>
                        <li>
                            <a href="{{route('admin.report.lembur')}}">Overtime (Per/Employee)</a>
                        </li>
                         <li>
                            <a href="{{route('admin.report.penambahan')}}">Allowances</a>
                        </li>
                         <li>
                            <a href="{{route('admin.report.pengurangan')}}">Deduction</a>
                        </li>
                         <li>
                           <a href="{{route('admin.report.gaji')}}">Salary (All Employee)</a>
                        </li>
                         <li>
                            <a href="{{route('admin.report.gaji_karyawan')}}">Salary (Per/Employee)</a>
                        </li>
                    </ul>
                </li>
               <li>
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa-away fa fa-sticky-note"></i> Absent Summary</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu4">
                        <li>
                            <a href="#">Present / Absent</a>
                        </li>
                        <li>
                            <a href="#">Leave Amount</a>
                        </li>                      
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa-away fa fa-cog"></i> Setting</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        <li>
                            <a href="{{route('index.department')}}">Department</a>
                        </li>
                        <li>
                            <a href="{{route('index.leveling')}}">Levelling</a>
                        </li>
                        <li>
                            <a href="{{route('index.status')}}">Status</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                </form>
                                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="logout-btn" > {{ __('Logout') }}</a>
                                
                </div>
            </nav>                       
        

        <main class="py-4">
           
            @yield('content')
              @if ($message = Session::get('profile'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
              </div>
            @endif
        </main>
    </div>

 </div>
          <div class="card text-center" style="background-color: #222;color:#fff;border-radius: 0px; font-size: 14px;">
          <div class="card-header">
            24Slides
          </div>
         
        </div>
</div>

</div>

<script src="{{ asset('bootstrap/js/scroll.js') }}"></script>
<script src="{{ asset('bootstrap/js/photo.js') }}"></script>
  <link href="{{ asset('bootstrap/table/bootstrap-table.min.css') }}"  rel="stylesheet">
  <script src="{{ asset('bootstrap/table/tableExport.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table-locale-all.min.js') }}"></script>
  <script src="{{ asset('bootstrap/table/bootstrap-table-export.min.js') }}"></script>

</body>
</html>  