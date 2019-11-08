<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
     
        $http = new \GuzzleHttp\Client;

        try {

            $response = $http->post(config('services.passport.url'),[
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id'  =>  config('services.passport.client_id'),
                    'client_secret' => config('services.passport.secret'),
                    'username' => $request->email,
                    'password' => $request->password
                ]
            ]);

            return $response->getBody();

        } 
        catch(\GuzzleHttp\Exception\BadResponseException $e)
        {
            if($e->getCode() ===  400) 
            {
           
                return response()->json([
                    'error' => 400,
                    'message' => 'Invalid Request',
                ]);
            }  
            else if($e->getCode() === 401)
            {
                return response()->json([
                    'error' => 401,
                    'message' => 'Your credintials is not valid',
                ]);
            }
          
                return response()->json('Something went wrong on the server..' + $e->getCode());
            
        }
    }

    public function register(Request $request)
    {
        $request->validate([

            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',

        ]);     

        return User::create([

            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
    }

    public function logout(){

        auth()->user()->tokens->each(function($tokens,$key){

            $tokens->delete();

        });

        return response()->json('successfully logout',200);
    }
}
