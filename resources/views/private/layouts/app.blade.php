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
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />-->
  
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> -->
  <!-- CSS Files -->
  <link href="{{asset('material/assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />

  <link href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet"/>

  <link href="{{asset('fonts/material-design-icons/iconfont/material-icons.css')}}" rel="stylesheet"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script> window.laravel = {  csrfToken :  '{{ csrf_token() }}'} </script>  

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ 
    selector:'textarea.texteditor',
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
});</script>

        
</head>

<body class="">
  
  <app-component id="app">


  </app-component>

  <!-- Vue JS Script -->
  <script src="{{asset('js/app.js')}}" ></script>
  
  <!--   Core JS Files   -->
  <script src="{{asset('/material/assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/material/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/material/assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/material/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  {{-- <script src="{{asset('/js/material.js')}}"></script> --}}
  <script src="{{asset('/js/events.js')}}"></script>
   <!-- Google Maps Plugin   
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chartist JS -->
  <script src="{{asset('/material/assets/js/plugins/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('/material/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('/material/assets/js/material-dashboard.min.js?v=2.1.0')}}" type="text/javascript"></script>
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script> -->

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>