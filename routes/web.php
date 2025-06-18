<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect('/admin/dashboard')
        : redirect('/customer/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::post('book-tour/{tour}', [App\Http\Controllers\Customer\BookingController::class, 'store'])->name('bookings.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('destinations', \App\Http\Controllers\Admin\DestinationController::class);
    Route::resource('tours', \App\Http\Controllers\Admin\TourController::class);
});

Route::middleware(['auth', 'verified'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('dashboard', function () {
        return view('customer.dashboard');
    })->name('dashboard');

    Route::get('bookings', [App\Http\Controllers\Customer\BookingController::class, 'index'])->name('bookings.index');
    Route::get('profile', [App\Http\Controllers\Customer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [App\Http\Controllers\Customer\ProfileController::class, 'update'])->name('profile.update');
});



require __DIR__.'/auth.php';
