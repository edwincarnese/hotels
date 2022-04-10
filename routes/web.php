<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TourController;
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
Route::get('tours', [TourController::class, 'index'])->name('tours.index');
Route::get('tours/{id}', [TourController::class, 'show'])->name('tours.show');
Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('hotels-unit/{id}', [HotelController::class, 'show'])->name('hotels.unit.show');
Route::post('book-hotel/{id}', [BookingController::class, 'show'])->name('booking.hotel.show');
Route::post('book-hotel', [BookingController::class, 'book'])->name('booking.hotel.book');

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('dashboard/update-profile', [DashboardController::class, 'updateProfile'])->name('dashboard.update.profile');
    Route::post('dashboard/update-password', [DashboardController::class, 'updatePassword'])->name('dashboard.update.password');
    Route::get('dashboard/units/create', [UnitController::class, 'create'])->name('dashboard.units.create');
    Route::get('dashboard/units/edit/{id}', [UnitController::class, 'edit'])->name('dashboard.units.edit');
    Route::put('dashboard/units/update', [UnitController::class, 'update'])->name('dashboard.units.update');
    Route::post('dashboard/units/store', [UnitController::class, 'store'])->name('dashboard.units.store');
    Route::post('dashboard/units/approve/{id}', [UnitController::class, 'approve'])->name('dashboard.units.approve');
    Route::delete('dashboard/units/{id}', [UnitController::class, 'destroy'])->name('dashboard.units.destroy');
    
    Route::get('dashboard/tours/create', [TourController::class, 'create'])->name('dashboard.tours.create');
    Route::get('dashboard/tours/edit/{id}', [TourController::class, 'edit'])->name('dashboard.tours.edit');
    Route::put('dashboard/tours/update', [TourController::class, 'update'])->name('dashboard.tours.update');
    Route::post('dashboard/tours/store', [TourController::class, 'store'])->name('dashboard.tours.store');
    Route::post('dashboard/tours/approve/{id}', [TourController::class, 'approve'])->name('dashboard.tours.approve');
    Route::delete('dashboard/tours/{id}', [TourController::class, 'destroy'])->name('dashboard.tours.destroy');
});
