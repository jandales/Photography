<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/material/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('/material/assets/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{asset('material/assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script> window.laravel = {  csrfToken :  '{{ csrf_token() }}'} </script>  

        
</head>

<body class="">
  <div class="wrapper ">
    <div class="content">
      <div class="container-fluid">
        <div id="app">
            @yield('content')
        </div>
        
      </div>
   
    </div>
  </div>
  <!-- Vue JS Script -->
  <script src="{{asset('js/app.js')}}" ></script>
  <!--   Core JS Files   -->
  <script src="{{asset('/material/assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/material/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/material/assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/material/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="{{asset('/material/assets/js/plugins/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('/material/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('/material/assets/js/material-dashboard.min.js?v=2.1.0')}}" type="text/javascript"></script>

 
</body>

</html>