<?php

use App\Http\Controllers\BlogPost;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [BlogPostController::class, 'showLatestBlog'])->name('welcome');
Route::get('/blogDetails/{id}', [BlogPost::class, 'blogDetails'])->name('blogDetails');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BlogPostController::class, 'showLatestBlog'])->name('dashboard');

    Route::post('/like/{post}', [LikeController::class, 'like'])->name('like');

    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/comments/{postId}', [CommentController::class, 'index']);
    Route::get('/comments/count/{post_id}', [CommentController::class, 'getCommentCount']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', \App\Http\Middleware\AuthorMiddleware::class])->group(function () {
    Route::get('/author/dashboard', [HomeController::class, 'showLatestBlog'])->name('author.dashboard');

    Route::get('/author/dashboard/createBlogPost', [HomeController::class, 'create'])->name('author.createBlogPost');
    Route::post('/author/dashboard/posts', [HomeController::class, 'store'])->name('author.posts.store');

    Route::get('/author/dashboardPage', [HomeController::class, 'dashboardPage'])->name('author.dashboardPage');

    Route::get('/author/dashboardPage/edit/{id}', [BlogPost::class, 'edit'])->name('author.posts.edit');
    Route::put('/author/dashboardPage/update/{id}', [BlogPost::class, 'update'])->name('author.posts.update');
    Route::delete('/author/dashboardPage/{id}', [BlogPost::class, 'destroy'])->name('author.posts.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'showLatestBlog'])->name('admin.dashboard');

    Route::get('/admin/dashboard/createBlogPost', [HomeController::class, 'createPost'])->name('createBlogPost');
    Route::post('/admin/dashboard/posts', [HomeController::class, 'store'])->name('posts.store');

    Route::get('/admin/dashboardPage', [HomeController::class, 'dashboardPage'])->name('profile.dashboardPage');

    Route::get('/admin/dashboardPage/edit/{id}', [BlogPost::class, 'edit'])->name('posts.edit');
    Route::put('/admin/dashboardPage/update/{id}', [BlogPost::class, 'update'])->name('posts.update');
    Route::delete('/admin/dashboardPage/{id}', [BlogPost::class, 'destroy'])->name('posts.destroy');
});

require __DIR__ . '/auth.php';
