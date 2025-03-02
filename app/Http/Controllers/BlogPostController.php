<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function showLatestBlog()
    {
        $posts = Post::latest()->get(); 
        return view('dashboard', compact('posts'));
    }

    public function createPost()
    {
        $categories = Category::all();
        return view('createBlogPost', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|string',
        ]);

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'image' => $request->input('image'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }
}
