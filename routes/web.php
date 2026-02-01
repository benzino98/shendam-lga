<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\DocumentController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// Blog/News Routes
Route::get('/news', [PostController::class, 'index'])->name('posts.index');
Route::get('/news/{slug}', [PostController::class, 'show'])->name('posts.show');

// Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

// Documents Routes
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
// More specific routes must come before the generic {slug} route
Route::get('/documents/{slug}/preview', [DocumentController::class, 'preview'])->name('documents.preview');
Route::get('/documents/{slug}/download', [DocumentController::class, 'download'])->name('documents.download');
Route::get('/documents/{slug}', [DocumentController::class, 'show'])->name('documents.show');

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
