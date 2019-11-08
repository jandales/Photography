@extends('public.layout.app')

@section('content')
<div class="blog">
        <div class="page-title">
                <h1 class="text-center">Blog</h1>
               <hr>
            </div>
            
            
            <div class="grid">
            <div class="grid-sizer"></div>
            <div class="grid-item">
                 <div class="posts">
                   <img src="{{asset('img/kira-and-lacus2.jpeg')}}">
                   <a href="blog-view.html" class="title">Raftel the last island, luffy will fint it ? or blackbeard will find it fisrt</a>
                   <p class="content">When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence</p>
                   <a href="#" class="read-more">Read more</a>
               </div>
            </div>
            
            <div class="grid-item">
                   <div class="posts">
                   <img  src="{{asset('img/eri-and-harima8.jpg')}}">
                   <a href="blog-view.html" class="title">Buruto will success to control the joujan?</a>
                   <p class="content">When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence</p>
                   <a href="#" class="read-more">Read more</a>
               </div>
            </div>
            
            <div class="grid-item">
                  <div class="posts">
                   <img  src="{{asset('img/ramdom-portrait8.jpeg')}}">
                   <a href="blog-view.html" class="title">I shall focus with photographs</a>
                   <p class="content">When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence</p>
                   <a href="#" class="read-more">Read more</a>
               </div>
            </div>
            
             <div class="grid-item">
                 <div class="posts">
                   <img  src="{{asset('img/ramdom-portrait2.jpeg')}}">
                   <a href="blog-view.html" class="title">I shall focus with photographs</a>
                   <p class="content">When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence</p>
                   <a href="#" class="read-more">Read more</a>
               </div>
            </div>
            
            
            <div class="grid-item">
               
                  <div class="posts">
                   <img  src="{{asset('img/ramdom-portrait7.jpeg')}}">
                   <a href="blog-view.html" class="title">I shall focus with photographs</a>
                   <p class="content">When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence</p>
                   <a href="#" class="read-more">Read more</a>
               </div>
            </div>
            
            
            <div class="grid-item">
                <div class="posts">
                   <img  src="{{asset('img/eren-and-mikaza9.jpeg')}}">
                   <a href="blog-view.html" class="title">My romantic comedy is wrong as I espected</a>
                   <p class="content">When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence</p>
                   <a href="#" class="read-more">Read more</a>
               </div>
            </div>
            
            <div class="grid-item">
               
               <div class="posts">
                   <img  src="{{asset('img/eri-and-harima4.jpg')}}">
                   <a href="blog-view.html" class="title">My romantic comedy is wrong as I espected</a>
                   <p class="content">When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence</p>
                   <a href="#" class="read-more">Read more</a>
               </div>
            </div>
            
            
            
            
            
            </div>
            <button class="view-more text-center">View More</button>

</div>
@endsection