<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Public Posts View
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Admin Posts View
    public function adminIndex()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // Create Post View (Admin)
    public function create()
    {
        return view('admin.posts.create');
    }

    // Store Post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    // Edit Post View (Admin)
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Update Post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->only(['title', 'content']));

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete Post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}
?>