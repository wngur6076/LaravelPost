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
        $input = request()->only(['email', 'password']);
        $input['password'] = bcrypt($input['password']);
        return User::create($input) ? redirect('/auth/login')
            : redirect()->back();
    }
}
