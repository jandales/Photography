<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
           
            return response()->json([

                'name' => env('COMPANY_NAME'),

                'address' => env('COMPANY_ADDRESS'),

                'email' => env('COMPANY_EMAIL_ADDRESS'),

                'phone' => env('COMPANY_PHONE_NUMBER'),

                'perpage' => env('PERPAGE')
            ]);
    }

    

}
