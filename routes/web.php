<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('public.index');
});

Route::get('/about',function(){
    return view('public.about');
});

Route::get('/services',function(){
    return view('public.services');
});

Route::get('/blog',function(){
    return view('public.blog');
});

Route::post('/login','AuthController@login');

Route::post('/register','AuthController@register')->name('register');


Route::get('/login',function(){

    return view('auth.login');

})->name('login');


Route::get('/{any}', function(){

    return view('private.index');
    
})->where('any', '.*');

Route::get('/ph-admin',function(){

    return view('private.index');

});






