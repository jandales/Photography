<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('fonts/ionicons.min.css')}}">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>

<body>
    <div class="header">
              <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="/">Jess Porfolio</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="\about">About</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="\services">Services</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="\blog">Blog</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link nav-bordered" href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Message</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">

        @yield('content')
    </div>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
              
         
              
                    <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">Company Name © 2017</p>
            </div>
        </footer>
    </div>



    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/masonry/masonry.pkgd.min.js')}}"></script>
    <script type='text/javascript'>
        var container = document.querySelector('.grid');
        var msnry = new Masonry( container, {
           itemSelector: '.grid-item',
           columnWidth: '.grid-sizer',
           percentPosition: true
        });          
</script>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>

</html>