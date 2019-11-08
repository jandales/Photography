<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Album;


class AdminController extends Controller
{
  

    public function index()
    {       
        return view('private.index');
    }

    public function profile()
    {      
        $user = Auth::user();
        return view('private.profile',['user' => $user]); 
    }
    public function posts()
    {
        return view('private.posts');
    }

    public function albums()
    {
        $albums = Album::paginate(10);
        return view('private.albums',['albums' => $albums]);
    }

    public function messages()
    {
        return view('private.messages');
    }

    public function comments()
    {
        return view('private.comments');
    }

    public function users()
    {
       
    }
    public function settings()
    {
        return view('private.settings');
    }
}
