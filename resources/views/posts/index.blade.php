@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    @foreach($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p><small>By: {{ $post->user->name }}</small></p>
        </div>
    @endforeach
    {{ $posts->links() }}
</div>
@endsection
