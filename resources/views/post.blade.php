@extends('layouts.app')

@section('content')
    <div id="main__form-post">
        <form action="<?=$requestUrl?>" method="POST">
            @csrf
            @if (isset($method))
            <input type="hidden" name="_method" value="{{ $method }}">
            @endif
            <input type="text" value="<?=$post->title ?? ''?>" name="title" placeholder="Type a post title"
                class="uk-input uk-article-title">
            <hr>
            <div class="editor uk-align-center">
                <textarea name="content"></textarea>
                <div id="editor"><?=$post->content ?? ''?></div>
            </div>
            <input type="submit" value="Submit" class="uk-button uk-button-default uk-width-1-1">
        </form>
    </div>
@endsection
