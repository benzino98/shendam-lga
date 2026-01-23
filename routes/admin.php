<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group.
|
*/

Route::middleware(['auth', 'admin', \App\Http\Middleware\LogAdminActivity::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    // Pages Management
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    
    // Posts/Blog Management
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    
    // Gallery Management
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);
    Route::post('galleries/{gallery}/images', [\App\Http\Controllers\Admin\GalleryController::class, 'uploadImage'])->name('galleries.images.upload');
    Route::delete('galleries/{gallery}/images/{image}', [\App\Http\Controllers\Admin\GalleryController::class, 'deleteImage'])->name('galleries.images.delete');
    
    // Documents Management
    Route::resource('documents', \App\Http\Controllers\Admin\DocumentController::class);
    Route::resource('document-categories', \App\Http\Controllers\Admin\DocumentCategoryController::class);
    
    // Settings
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    
    // Activity Logs
    Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('access-logs', [\App\Http\Controllers\Admin\AccessLogController::class, 'index'])->name('access-logs.index');
});



