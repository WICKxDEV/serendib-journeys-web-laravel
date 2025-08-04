<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Common\TourController;
use App\Http\Controllers\Common\BlogController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;

// ✅ Public Home Page (Common)
Route::get('/', [\App\Http\Controllers\Common\HomeController::class, 'index'])->name('home');

Route::view('/about', 'common.about')->name('about');
Route::get('/services', [\App\Http\Controllers\Common\ServiceController::class, 'index'])->name('services');
Route::get('/packages', [\App\Http\Controllers\Common\TourController::class, 'index'])->name('packages');
Route::get('/tours/{tour}', [\App\Http\Controllers\Common\TourController::class, 'show'])->name('tours.show');
Route::view('/gallery', 'common.gallery')->name('gallery');
Route::view('/contact', 'common.contact')->name('contact');

// ✅ After Login Redirection based on Role
Route::get('/dashboard', function () {
    if (auth()->user()->roles()->where('slug', 'admin')->exists()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Common Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Admin Routes (Protected by 'admin' middleware)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');

    // Admin Resource Routes
    Route::resource('destinations', App\Http\Controllers\Admin\DestinationController::class);
    Route::resource('tours', App\Http\Controllers\Admin\TourController::class);
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class);
    Route::resource('settings', App\Http\Controllers\Admin\SettingController::class);

    // Settings specific routes
    Route::post('settings/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::patch('settings/{setting}/update', [App\Http\Controllers\Admin\SettingController::class, 'updateSetting'])->name('settings.updateSetting');

    // Booking Status Change (Approve/Cancel/Refund)
    Route::post('bookings/{booking}/change-status', [App\Http\Controllers\Admin\BookingController::class, 'changeStatus'])->name('bookings.changeStatus');

    Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{setting}', [SettingController::class, 'updateSetting'])->name('settings.update.setting');
    Route::delete('/settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');

    Route::get('guides', [UserController::class, 'guides'])->name('guides');
    Route::get('guides/create', [UserController::class, 'createGuide'])->name('guides.create');
    Route::post('guides', [UserController::class, 'storeGuide'])->name('guides.store');
});

// ✅ Customer Routes (Protected by 'customer' middleware)
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('dashboard', App\Http\Controllers\Customer\DashboardController::class)->name('dashboard');

    // Booking Routes
    Route::get('bookings', [\App\Http\Controllers\Customer\BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [\App\Http\Controllers\Customer\BookingController::class, 'show'])->name('bookings.show');
    Route::post('bookings/{booking}/cancel', [\App\Http\Controllers\Customer\BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('bookings/create/{tour?}', [\App\Http\Controllers\Customer\BookingController::class, 'create'])->name('booking.create');

    // Customer Profile Routes
    // Route::get('profile', [App\Http\Controllers\Customer\ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('profile', [App\Http\Controllers\Customer\ProfileController::class, 'update'])->name('profile.update');

    // Payment Routes
    Route::post('checkout/{tour}', [App\Http\Controllers\Customer\PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('process-payment', [App\Http\Controllers\Customer\PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('payment-success', [App\Http\Controllers\Customer\PaymentController::class, 'success'])->name('payment.success');
    Route::get('payment-cancel', [App\Http\Controllers\Customer\PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Stripe Webhook (no auth required)
Route::post('stripe/webhook', [App\Http\Controllers\Customer\PaymentController::class, 'webhook'])->name('stripe.webhook');

Route::get('/blog', [\App\Http\Controllers\Common\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [\App\Http\Controllers\Common\BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth', 'role:tour-guide'])->prefix('guide')->name('guide.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Guide\DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/booking', [\App\Http\Controllers\Common\BookingController::class, 'showForm'])->name('booking.form');
Route::post('/booking', [\App\Http\Controllers\Common\BookingController::class, 'submit'])->name('booking.submit');
Route::get('/booking/payment-success', [\App\Http\Controllers\Common\BookingController::class, 'paymentSuccess'])->name('booking.payment.success');
Route::get('/booking/payment-cancel', [\App\Http\Controllers\Common\BookingController::class, 'paymentCancel'])->name('booking.payment.cancel');

require __DIR__.'/auth.php';
