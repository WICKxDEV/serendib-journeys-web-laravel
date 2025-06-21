<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

// ✅ Public Home Page (Common)
Route::get('/', function () {
    return view('common.home');
})->name('home');

Route::get('/about', function () {
    return view('common.about'); // resources/views/about.blade.php
})->name('about');

Route::get('/services', function () {
    return view('common.service'); // resources/views/service.blade.php
})->name('services');

Route::get('/packages', function () {
    return view('common.package'); // resources/views/package.blade.php
})->name('packages');

Route::get('/gallery', function () {
    return view('common.gallery'); // resources/views/gallery.blade.php
})->name('gallery');

Route::get('/contact', function () {
    return view('common.contact'); // resources/views/contact.blade.php
})->name('contact');

// ✅ After Login Redirection based on Role
Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Common Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Admin Routes (Protected by 'admin' middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin Resource Routes
    Route::resource('destinations', App\Http\Controllers\Admin\DestinationController::class);
    Route::resource('tours', App\Http\Controllers\Admin\TourController::class);
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);

    // Booking Status Change (Approve/Cancel/Refund)
    Route::post('bookings/{booking}/change-status', [App\Http\Controllers\Admin\BookingController::class, 'changeStatus'])->name('bookings.changeStatus');
});

// ✅ Customer Routes (Protected by 'customer' middleware)
Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');

    // Booking Routes
    Route::get('bookings', [App\Http\Controllers\Customer\BookingController::class, 'index'])->name('bookings.index');
    Route::post('book-tour/{tour}', [App\Http\Controllers\Customer\BookingController::class, 'store'])->name('bookings.store');

    // Customer Profile Routes
    Route::get('profile', [App\Http\Controllers\Customer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [App\Http\Controllers\Customer\ProfileController::class, 'update'])->name('profile.update');

    // Payment Routes
    Route::post('checkout/{tour}', [App\Http\Controllers\Customer\PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('payment-success', [App\Http\Controllers\Customer\PaymentController::class, 'success'])->name('payment.success');
    Route::get('payment-cancel', [App\Http\Controllers\Customer\PaymentController::class, 'cancel'])->name('payment.cancel');
});



require __DIR__.'/auth.php';
