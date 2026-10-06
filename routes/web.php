<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts');

// route sampah ditaruh sebelum resource supaya "posts/trash" ga dianggap {post}
Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
Route::patch('posts/{post}/restore', [PostController::class, 'restore'])->withTrashed()->name('posts.restore');
Route::delete('posts/{post}/force', [PostController::class, 'forceDelete'])->withTrashed()->name('posts.force-delete');

Route::resource('posts', PostController::class);
