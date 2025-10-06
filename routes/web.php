<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// About page route
Route::get('/about', function () {
    return view('About');
})->name('about');

// Movie routes
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

Route::get('/movie', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');

// Authentication routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
