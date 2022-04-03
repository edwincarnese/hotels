<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('hotels-unit/{id}', [HotelController::class, 'show'])->name('hotels.unit.show');
Route::get('book-hotel/{id}', [BookingController::class, 'show'])->name('booking.hotel.show');

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('dashboard/update-profile', [DashboardController::class, 'updateProfile'])->name('dashboard.update.profile');
    Route::post('dashboard/update-password', [DashboardController::class, 'updatePassword'])->name('dashboard.update.password');
    Route::get('dashboard/units/create', [UnitController::class, 'index'])->name('dashboard.units.create');
    Route::post('dashboard/units/store', [UnitController::class, 'store'])->name('dashboard.units.store');
    Route::delete('dashboard/units/{id}', [UnitController::class, 'destroy'])->name('dashboard.units.destroy');
});
