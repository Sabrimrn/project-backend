<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GamerProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Public routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

//Profile routes
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Contact Message
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

//Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    //User management
    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    
    // News management
    Route::resource('news', AdminNewsController::class)->names('news');
    Route::get('/news/create', [AdminNewsController::class, 'create'])->name('news.create');

    // FAQ categorieën
    Route::get('/faq/categories', [AdminFaqController::class, 'categories'])->name('faq.categories');
    Route::get('/faq/categories/create', [AdminFaqController::class, 'createCategory'])->name('faq.categories.create');
    Route::post('/faq/categories', [AdminFaqController::class, 'storeCategory'])->name('faq.categories.store');

    // FAQ items
    Route::get('/faq/edit', [AdminFaqController::class, 'items'])->name('faq.edit');
    Route::get('/faq/create', [AdminFaqController::class, 'createItem'])->name('faq.create');
    Route::post('/faq/items', [AdminFaqController::class, 'storeItem'])->name('faq.items.store');
        
    // Contact messages
        Route::get('contact', [AdminContactController::class, 'index'])->name('contact.index');
        Route::get('contact/{id}', [AdminContactController::class, 'show'])->name('contact.show');
        Route::delete('contact/{id}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
});

require __DIR__.'/auth.php';
