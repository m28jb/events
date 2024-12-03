@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create Post</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
@endsection
