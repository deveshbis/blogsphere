<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function showLatestBlog(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->input('category');

        $posts = Post::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('categories.id', $selectedCategory);
            });
        })->latest()->paginate(10);

        return view('dashboard', compact('posts', 'categories', 'selectedCategory'));
    }
}
