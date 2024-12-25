<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

// Rute default untuk URL '/' yang hanya bisa diakses sebelum login
Route::get('/', function () {
    return view('auth.login'); // Pastikan view auth.login ada
});
// Menggunakan middleware auth untuk memastikan hanya yang sudah login yang bisa mengakses route berikutnya
Route::middleware('auth')->group(function () {

    // Rute resource untuk blogs
    Route::resource('blogs', BlogController::class);

    // Rute untuk menyimpan komentar pada blog
    Route::post('blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Rute untuk halaman home setelah login
    // Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Group untuk admin
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
        Route::group(['prefix' => 'blogs'], function () {
            Route::get('/', [BlogController::class, 'index'])->name('admin.blogs.index');
            Route::get('/create', [BlogController::class, 'create'])->name('admin.blogs.create');
            Route::post('/', [BlogController::class, 'store'])->name('admin.blogs.store');
            Route::get('/{blog}', [BlogController::class, 'show'])->name('admin.blogs.show');
            Route::put('/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');
            Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
            Route::resource('comments', CommentController::class)->except(['create', 'store']);
        });
    });

    // Group untuk user biasa
    Route::group(['prefix' => 'user', 'middleware' => ['user']], function () {
        Route::group(['prefix' => 'blogs'], function () {
            Route::get('/{blog}', [BlogController::class, 'show'])->name('user.blogs.show');
            Route::post('blogs/{blog}/comments', [CommentController::class, 'store'])->name('user.comments.store');
        });
    });
});

// Rute untuk login dan logout
Auth::routes();

// Rute untuk logout dengan metode POST
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
