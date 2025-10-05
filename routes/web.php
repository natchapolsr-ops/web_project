
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

use App\Http\Livewire\Movies\Index as MoviesIndex;
use App\Http\Livewire\Movies\Show as MovieShow;
use App\Http\Livewire\Bookings\SeatSelector;
use App\Http\Livewire\Bookings\Show as BookingShow;
use App\Http\Controllers\BookingController;
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', MoviesIndex::class)->name('home');
Route::get('/movies', MoviesIndex::class)->name('movies.index');
Route::get('/movies/{movie}', MovieShow::class)->name('movies.show');
Route::get('/showtimes/{showtime}/select', SeatSelector::class)->name('bookings.select');
Route::get('/bookings/{booking}', BookingShow::class)->name('bookings.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
