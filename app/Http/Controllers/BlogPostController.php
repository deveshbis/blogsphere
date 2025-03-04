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

}
