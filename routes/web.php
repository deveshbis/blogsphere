<?php

use App\Http\Controllers\BlogPost;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BlogPostController::class, 'showLatestBlog'])->name('dashboard');
    Route::get('/blogDetails/{id}', [BlogPost::class, 'blogDetails'])->name('blogDetails');

    Route::post('/like/{post}', [LikeController::class, 'like'])->name('like');
    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/comments/{postId}', [CommentController::class, 'index']);
    Route::get('/comments/count/{post_id}', [CommentController::class, 'getCommentCount']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'showLatestBlog'])->name('admin.dashboard');
    Route::get('/admin/dashboard/createBlogPost', [HomeController::class, 'createPost'])->name('createBlogPost');
    Route::post('/admin/dashboard/posts', [HomeController::class, 'store'])->name('posts.store');
    Route::get('/admin/dashboardPage', [HomeController::class, 'dashboardPage'])->name('profile.dashboardPage');
    Route::get('/admin/dashboardPage/edit/{id}', [BlogPost::class, 'edit'])->name('posts.edit');
    Route::put('/admin/dashboardPage/update/{id}', [BlogPost::class, 'update'])->name('posts.update');
    Route::delete('/admin/dashboardPage/{id}', [BlogPost::class, 'destroy'])->name('posts.destroy');
    // Route::get('admin/dashboard', [HomeController::class, 'showLatestBlog'])->name('dashboard');
});
