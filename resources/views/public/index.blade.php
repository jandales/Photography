@extends('public.layout.app')

@section('content')
    
    <div class="nav-category">
        <ul class="category">
            <li><a href="#" class="">ARCHITECTURE</a></li>
            <li><a href="#" class="">EDITORIAL</a></li>
            <li><a href="#" class="">PORTRAITS</a></li>
            <li><a href="#" class="">Travel</a></li>

        </ul>
    </div>



<div class="grid">
    <div class="grid-sizer"></div>
  <div class="grid-item">
       <img src="{{asset('img/eri-and-harima1.jpg')}}">
   
  </div>
  <div class="grid-item grid-item--width2">
     <img src="{{asset('img/eri-and-harima2.jpg')}}">
  </div>
  <div class="grid-item">
     <img src="{{asset('img/eri-and-harima3.jpg')}}">
  </div>
    <div class="grid-item">
     <img src="{{asset('img/eri-and-harima4.jpg')}}">
  </div>
  <div class="grid-item grid-item--width2">
        <img src="{{asset('img/eri-and-harima5.jpg')}}">
  </div>
  <div class="grid-item">
        <img src="{{asset('img/eri-and-harima6.jpg')}}">
  </div>
    <div class="grid-item">
        <img src="{{asset('img/eri-and-harima7.jpg')}}">
  </div>
      <div class="grid-item">
        <img src="{{asset('img/eri-and-harima8.jpg')}}">
  </div>

</div>

        <button class="view-more">View More</button>
  @endsection