<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use PharIo\Manifest\Author;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post')->with([
            'requestUrl' => '/posts'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = request()->only(['title', 'content']);

        return User::find(auth()->user()->id)->posts()->create($post)
            ? redirect('/') : redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($post = Post::find($id))
            return view('read')->with([
                'post' => $post
            ]);
        return response('에러발생!', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($post = Post::find($id)) {
            return view('post')->with([
                'post' => $post,
                'requestUrl' => '/posts/' . $post->id,
                'method' => 'patch'
            ]);
        }
        return response('에러발생!', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($post = Post::find($id)) {
            $post->title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $post->content = filter_input(INPUT_POST, 'content');

            return ($post->isOwner() && $post->update())
                ? redirect('/posts/' . $post->id)
                : redirect()->back();
        }
        return response('에러발생!', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($post = Post::find($id)) {
            if ($post->isOwner() && $post->delete())
                return http_response_code(204);
        }
        return response('에러발생!', 404);
    }
}
