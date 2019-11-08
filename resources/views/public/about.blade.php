@extends('public.layout.app')
@section('content')
<div class="page-title">
    <h1 class="text-center">About</h1>
    <hr>
  </div>

    <div class="about">

      <div class="about-image">
         <img class="img-fluid" src="{{asset('img/ramdom-portrait4.jpeg')}}">
      </div>
      <div class="about-content">
          <h5>I'm Jesus Andales</h5>
          <P> ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>        
        
          <div class="contact">
                   <h5>Contact Me</h5>


          <ul class="parent">
            <li><i class="fas fa-map-marker-alt"></i> Business Address
              <ul class="child">
                <li><i class="fas fa-angle-right"></i> Nal't Highway, Bgy. San Pedro</li>
                <li><i class="fas fa-angle-right"></i> Puerto Pricesa City</li>
                <li><i class="fas fa-angle-right"></i> Palawan</li>
              </ul>
            </li>
            <li><i class="fas fa-envelope"></i> Email Address
                <ul class="child">
                  <li><i class="fas fa-angle-right"></i> jesusandales021993@yahoo.com</li>
                  <li><i class="fas fa-angle-right"></i> jesusandales@gmail.com</li>
                </ul>
            </li>
            <li><i class="fas fa-phone-square"></i> Contact Number
             <ul class="child"> 
               <li><i class="fas fa-angle-right"></i> 09261206130</li>
               <li><i class="fas fa-angle-right"></i> 09261206120</li>
             </ul>
              
            </li>
          </ul>
          </div>


      </div>
    
      

    </div>
@endsection