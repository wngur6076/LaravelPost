<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function ShowLoginForm()
    {
        return view('auth')->with([
            'requestUrl' => '/auth'
        ]);
    }
}
