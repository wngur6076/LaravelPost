<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth')->with([
            'requestUrl' => '/auth'
        ]);
    }

    public function login()
    {
        if (! Auth::attempt(request()->only(['email', 'password']))) {
            return redirect()->back();
        }

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
