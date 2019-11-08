@extends('public.layout.app')
@section('content')
<div class="page-title">
    <h1 class="text-center">Services</h1>

   <hr>
</div>


<div class="grid-services">
                       
   <div class="services">
       <img src="{{asset('img/architecture.jpg')}}"/>
       <div class="content">
           <h5>ARCHITECTURE</h5>
           <p>  ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat.</p>
           <a href="#" class="">View</a>
       </div>


   </div>

     <div class="services">
       <img src="{{asset('img/analog.jpg')}}"/>
       <div class="content">
           <h5>EDITORIAL</h5>
           <p>  ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat.</p>
           <a href="#" class="">View</a>
       </div>


   </div>

    <div class="services">
       <img src="{{asset('img/portraits.jpg')}}"/>
       <div class="content">
           <h5>PORTRAITS</h5>
           <p>  ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat.</p>
           <a href="#" class="">View</a>
       </div>


   </div>

   <div class="services">
       <img src="{{asset('img/travel.jpg')}}"/>
       <div class="content">
           <h5>Travel</h5>
           <p>  ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat.</p>
           <a href="#" class="">View</a>
       </div>


   </div>
       
</div>
@endsection