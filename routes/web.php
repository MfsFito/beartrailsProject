<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TourguideProfileController;

// Halaman Utama
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/explore', [App\Http\Controllers\ExploreController::class, 'index'])->name('explore');

// Destinations (publik)
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');

// Tour Guides (publik)
Route::get('/tourguides', [TourguideProfileController::class, 'index'])->name('tourguides.index');
Route::get('/tourguides/{tourguideProfile}', [TourguideProfileController::class, 'show'])->name('tourguides.show');

// Routes untuk semua yang sudah login
Route::middleware('auth')->group(function () {
    // Profile Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reviews
    Route::post('/destinations/{destination}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Favorites
    Route::post('/destinations/{destination}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

// Routes khusus Tour Guide
Route::middleware(['auth', 'role:tourguide'])->prefix('tourguide')->group(function () {
    Route::get('/dashboard', [TourguideProfileController::class, 'dashboard'])->name('tourguide.dashboard');

    Route::get('/profile/edit', [TourguideProfileController::class, 'edit'])->name('tourguide.profile.edit');
    Route::post('/profile', [TourguideProfileController::class, 'update'])->name('tourguide.profile.update');

    // Availability CRUD
    Route::post('/availability', [TourguideProfileController::class, 'storeAvailability'])->name('tourguide.availability.store');
    Route::delete('/availability/{availability}', [TourguideProfileController::class, 'destroyAvailability'])->name('tourguide.availability.destroy');

    // Portfolio CRUD
    Route::post('/portfolio', [TourguideProfileController::class, 'storePortfolio'])->name('tourguide.portfolio.store');
    Route::delete('/portfolio/{portfolio}', [TourguideProfileController::class, 'destroyPortfolio'])->name('tourguide.portfolio.destroy');
});

// Routes khusus Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Destinasi
    Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');
    Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
    Route::get('/destinations/{destination}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
    Route::put('/destinations/{destination}', [DestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/destinations/{destination}', [DestinationController::class, 'destroy'])->name('destinations.destroy');
    Route::delete('/destinations/{destination}/images/{image}', [DestinationController::class, 'destroyImage'])->name('destinations.images.destroy');

    // Tour Guide
    Route::post('/tourguide', [App\Http\Controllers\AdminController::class, 'storeTourguide'])->name('admin.tourguide.store');
    Route::patch('/tourguide/{user}/toggle', [App\Http\Controllers\AdminController::class, 'toggleTourguide'])->name('admin.tourguide.toggle');
    Route::delete('/tourguide/{user}', [App\Http\Controllers\AdminController::class, 'destroyTourguide'])->name('admin.tourguide.destroy');

    // User
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

// Routes khusus User biasa
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');
});

require __DIR__.'/auth.php';