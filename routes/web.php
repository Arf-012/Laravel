<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return app(AuthController::class)
            ->redirectByRole(Auth::user());
    }
    return redirect()->route('show.login');
})->name('home');

Route::get('/products-all', [ProductController::class, 'list'])
    ->name('products.list')
    ->middleware('auth');

Route::resource('products', ProductController::class)->except(['show'])->middleware('auth');
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [UserProductController::class, 'index'])->name('dashboard');
    Route::resource('products', UserProductController::class)->except(['show']);
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
