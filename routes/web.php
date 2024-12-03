<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [PostController::class, 'index'])->name('home');

// Auth Routes
Auth::routes();

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->except(['index']);
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/posts', [PostController::class, 'adminIndex'])->name('admin.posts.index');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
});
