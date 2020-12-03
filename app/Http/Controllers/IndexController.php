<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $page = request()->input('page') ?: 0;

        return view('index')->with([
            'posts' => Post::orderBy('id', 'desc')->limit(3)->offset($page * 3)->get()
        ]);
    }
}
