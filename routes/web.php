<?php

use App\Http\Controllers\BlogPost;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/createBlogPost', [BlogPostController::class, 'createPost'])->name('createBlogPost');
    Route::post('/dashboard/posts', [BlogPostController::class, 'store'])->name('posts.store');

    Route::get('/dashboard', [BlogPostController::class, 'showLatestBlog'])->name('dashboard');

    Route::get('/dashboardPage', [BlogPostController::class, 'dashboardPage'])->name('profile.dashboardPage');
    Route::get('/dashboardPage/edit/{id}', [BlogPost::class, 'edit'])->name('posts.edit');
    Route::put('/dashboardPage/update/{id}', [BlogPost::class, 'update'])->name('posts.update');
    Route::delete('/dashboardPage/{id}', [BlogPost::class, 'destroy'])->name('posts.destroy');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
