<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\BookingController;

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

// Routes
Route::prefix('admin')->group(function () {
    // Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/all-users', [AdminController::class, 'showUsers'])->name('admin.viewUsers');
    Route::get('/get-users', [AdminController::class, 'getUsers'])->name('admin.getUsers');
    Route::get('/user/details/{id}', [AdminController::class, 'getUserDetails'])->name('admin.getUserDetails');
    Route::get('/airlines', [AdminController::class, 'showAirlines'])->name('admin.showAirlines');
    Route::get('/get-airlines', [AdminController::class, 'getAirlines'])->name('admin.getAirlines');
    Route::get('/airline/details/{id}', [AdminController::class, 'getAirlineDetails']);
    Route::get('/bookings', [AdminController::class, 'showBookings'])->name('admin.showBookings');
    Route::get('/get-bookings', [AdminController::class, 'getBookings'])->name('admin.getBookings');
    Route::get('/airline/details/{id}', [AdminController::class, 'getBookingDetails']);
});


Route::get('/admin', [AdminController::class, 'index'])->name('adminIndex');
Route::post('/user/book-flight', [BookingController::class, 'bookFlight'])->name('user.bookFlight');
Route::get('/book-flight', [BookingController::class, 'showBookingForm'])->name('show-book-flight');
Route::get('/get-booking-offices', [BookingController::class, 'getBookingOffices'])->name('user.getBookingOffices');
Route::get('/get-flights', [BookingController::class, 'getFlights'])->name('user.getFlights');
Route::get('/check-availability/{flightId}/{class}', [BookingController::class, 'checkAvailability']);
