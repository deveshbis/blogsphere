<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function showLatestBlog()
    {
        $posts = Post::latest()->get();
        return view('admin.dashboard', compact('posts'));
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

        return redirect()->route('admin.dashboard')->with('success', 'Post created successfully!');
    }

    public function dashboardPage()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/home')->with('error', 'You do not have access to the admin dashboard.');
        }
        $posts = Post::latest()->get();
        return view('admin.dashboardPage', compact('posts'));
    }
}
