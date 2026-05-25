<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolio;
use App\Http\Controllers\Admin\BlogController as AdminBlog;
use App\Http\Controllers\Admin\MediaController as AdminMedia;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Http\Controllers\Admin\ContactController as AdminContact;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/gallery', [MediaController::class, 'index'])->name('gallery');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Profile Routes (Standard Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by auth and admin role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('portfolio', AdminPortfolio::class);
    Route::resource('blog', AdminBlog::class);
    Route::resource('media', AdminMedia::class);
    Route::resource('categories', AdminCategory::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::get('/settings', [AdminSetting::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSetting::class, 'update'])->name('settings.update');

    Route::resource('seo', \App\Http\Controllers\Admin\PageSeoController::class);

    Route::get('/contacts', [AdminContact::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [AdminContact::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{id}', [AdminContact::class, 'destroy'])->name('contacts.destroy');
});

require __DIR__ . '/auth.php';
