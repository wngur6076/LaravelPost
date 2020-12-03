<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('auth')->with([
            'requestUrl' => '\users'
        ]);
    }

    public function store()
    {
        $user = request()->only(['email', 'password']);
        $user['password'] = bcrypt($user['password']);

        return User::create($user) ? redirect('/auth/login')
            : redirect()->back();
    }
}
