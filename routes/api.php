<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  
    return $request->user();
});

Route::middleware('auth:api')->post('/logout','AuthController@logout');




Route::group(['middleware' => ['auth:api'] ],function(){

    Route::get('/ph-admin','AdminController@index')->name('admin');
  
    Route::get('/ph-admin/messages','AdminController@messages')->name('messages');  

    Route::get('/ph-admin/settings','AdminController@settings')->name('settings');


    

    /*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/

    Route::get('/users','UsersController@index')->name('users');

    Route::post('/users/store','UsersController@store')->name('users.store');

    Route::get('/users/edit/{id}','UsersController@edit')->name('users.edit');

    Route::post('/users/update/{id}','UsersController@update')->name('users.update');

    Route::get('/users/delete/{id}','UsersController@destroy')->name('users.destroy');

    Route::get('/users/role/{id}','UsersController@changeRole')->name('users.role');

    Route::get('/users/delete','UsersController@delete')->name('users.delete');

    Route::get('/users/search','UsersController@search')->name('search');

    Route::get('/users/active','UsersController@active');

    Route::post('/users/profile/update','UsersController@updateprofile');

        /*
|--------------------------------------------------------------------------
| Categories Routes
|--------------------------------------------------------------------------
*/


Route::get('/categories','CategoriesController@index')->name('categories');

Route::get('/categories/all','CategoriesController@list');

Route::get('/categories/create','CategoriesController@create')->name('categories.create');

Route::post('/categories/store','CategoriesController@store')->name('categories.store');

Route::get('/categories/edit/{id}','CategoriesController@edit')->name('categories.edit');

Route::post('/categories/update/{id}','CategoriesController@update')->name('categories.update');

Route::get('/categories/delete/{id}','CategoriesController@destroy')->name('categories.destroy');

Route::get('/categories/delete','CategoriesController@delete')->name('categories.delete');

Route::get('/categories/search','CategoriesController@search')->name('categories.search');


/*
|--------------------------------------------------------------------------
| Albums Routes
|--------------------------------------------------------------------------
*/


Route::get('/albums','AlbumsController@index')->name('albums');

Route::post('/albums/store','AlbumsController@store')->name('albums.store');

Route::get('/albums/delete/{id}','AlbumsController@destroy')->name('albums.destroy');  

Route::get('/albums/delete','AlbumsController@delete')->name('albums.delete');

Route::get('/albums/show/{id}','AlbumsController@show')->name('albums.show');

Route::post('/albums/update/{id}','AlbumsController@update')->name('albums.update');

Route::get('/albums/delete/photos/{id}','AlbumsController@deletePhoto')->name('albums.deletephoto');

Route::get('/albums/deletephotos','AlbumsController@deletePhotos')->name('albums.deletephotos');

Route::get('/albums/search','AlbumsController@search')->name('albums.search');

Route::post('/albums/upload','AlbumsController@upload')->name('albums.upload');


/*
|--------------------------------------------------------------------------
| Posts Routes
|--------------------------------------------------------------------------
*/


Route::get('/posts','PostsController@index')->name('posts');    

Route::post('/posts/store','PostsController@store')->name('posts.store');

Route::get('/posts/edit/{id}','PostsController@edit')->name('posts.edit');

Route::get('/posts/delete/{id}','PostsController@destroy')->name('posts.destroy');

Route::post('/posts/update/{id}','PostsController@update')->name('posts.update');

Route::get('/posts/result','PostsController@search')->name('posts.search');

Route::get('/posts/delete','PostsController@delete')->name('posts.delete');

Route::get('/posts/status/{id}','PostsController@updatestatus')->name('posts.statusupdate');

Route::get('/ph-admin/posts/{id}/comments','PostsController@toComments')->name('posts.comments');

Route::get('/posts/search','PostsController@search');

/*
|--------------------------------------------------------------------------
| Comments Routes
|--------------------------------------------------------------------------
*/

Route::get('/comments','CommentsController@index')->name('comments');

Route::get('/comments/respond/{id}','CommentsController@respond');

Route::get('/comments/create/{id}','CommentsController@create')->name('Comments.create');

Route::post('/comments/store/{id}','CommentsController@store')->name('comments.store');

Route::get('/comments/{id}/show','CommentsController@show')->name('comments.show');

Route::post('/comments/replyByadmin','CommentsController@ReplyByAdmin')->name('comments.replyadmin');

Route::get('/comments/approved/{id}/{status}','CommentsController@approved')->name('comments.Approved');

Route::get('/comments/approveds','CommentsController@approveds'); 

Route::get('/comments/delete/{id}','CommentsController@destroy')->name('comments.destroy');

Route::get('/comments/deletes','CommentsController@delete')->name('comments.delete');



/*
|--------------------------------------------------------------------------
| Message Routes
|--------------------------------------------------------------------------
*/

Route::get('/messages/inbox','MessagesController@index');

Route::get('/messages/archived','MessagesController@archived');

Route::get('/messages/delete/{id}','MessagesController@destroy');

Route::get('/messages/deletes','MessagesController@deletes');

Route::post('/messages/sendbyClient','MessagesController@sendbyClient');

Route::post('/messages/SendbyAdmin','MessagesController@SendbyAdmin');

Route::get('/messages/read/{id}','MessagesController@read');

Route::get('/messages/unread/{id}','MessagesController@unread');

Route::get('/messages/toarchived/{id}','MessagesController@toarchived');

Route::get('/messages/toarchiveds','MessagesController@toarchiveds');

route::get('/messages/inbox/count/{id}','MessagesController@Count');

route::get('/messages/sentbox','MessagesController@sentBox');

route::get('/messages/isArchived/{id}','MessagesController@isArchived');

route::get('/messages/isArchiveds','MessagesController@isArchiveds');

route::get('/messages/unarchived/{id}','MessagesController@unarchived');

route::get('/messages/unarchiveds','MessagesController@unarchiveds'); 
/// Single delete message
route::get('/messages/isTrashed/{id}','MessagesController@isTrashed');
/// multi delete message
route::get('/messages/isTrasheds','MessagesController@isTrasheds');
///show messages
route::get('/messages/show/{id}','MessagesController@show');

route::get('/messages/trash','MessagesController@trash');

route::get('/messages/restore/{id}','MessagesController@restore');
    /// multi delete message
route::get('/messages/restores','MessagesController@restores');

route::get('/settings','SettingsController@index');



});