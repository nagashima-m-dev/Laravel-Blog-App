<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// トップは投稿一覧
Route::get('/', fn () => redirect()->route('posts.index'));

// 公開：未ログインでも閲覧OK
Route::resource('posts', PostController::class)
    ->only(['index', 'show'])
    ->whereNumber('post');

// 認証必須：投稿操作だけログイン必須
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)
        ->except(['index', 'show'])
        ->whereNumber('post');
});

require __DIR__.'/auth.php';
