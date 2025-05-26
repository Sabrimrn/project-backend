<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', [ProfileController::class, 'edit']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('users.store');
    Route::post('/users/{user}/toggle-admin', [App\Http\Controllers\AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
});

// HOME & PUBLIC ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');

// PUBLIC GAMING NEWS
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [PublicNewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [PublicNewsController::class, 'show'])->name('show');
});

// PUBLIC GAMING FAQ
Route::prefix('faq')->name('faq.')->group(function () {
    Route::get('/', [PublicFaqController::class, 'index'])->name('index');
    Route::get('/category/{slug}', [PublicFaqController::class, 'category'])->name('category');
});

// TOURNAMENT CONTACT
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// AUTHENTICATED USER ROUTES
Route::middleware('auth')->group(function () {
    // 🎮 GAMING PROFILE ROUTES
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        
        // Gaming specific profile routes
        Route::get('/gaming-stats', [ProfileController::class, 'gamingStats'])->name('gaming-stats');
        Route::post('/favorite-games', [ProfileController::class, 'updateFavoriteGames'])->name('favorite-games');
        Route::post('/gaming-preferences', [ProfileController::class, 'updateGamingPreferences'])->name('gaming-preferences');
    });
    
    // TOURNAMENT ROUTES (for future expansion)
    Route::prefix('tournaments')->name('tournaments.')->group(function () {
        Route::get('/', function() {
            return Inertia::render('Tournaments/Index');
        })->name('index');
        Route::get('/my-tournaments', function() {
            return Inertia::render('Tournaments/MyTournaments');
        })->name('my-tournaments');
    });
});

// ADMIN ROUTES
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // ADMIN DASHBOARD
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'total_users' => \App\Models\User::count(),
                'total_news' => \App\Models\News::count(),
                'total_faq_items' => \App\Models\FaqItem::count(),
                'total_messages' => \App\Models\ContactMessage::count(),
                'recent_news' => \App\Models\News::latest()->take(5)->get(),
                'recent_messages' => \App\Models\ContactMessage::latest()->take(5)->get(),
            ]
        ]);
    })->name('dashboard');
    
    // ADMIN NEWS MANAGEMENT
    Route::resource('news', NewsController::class)->except(['show']);
    Route::post('news/{news}/toggle-featured', [NewsController::class, 'toggleFeatured'])->name('news.toggle-featured');
    Route::post('news/bulk-delete', [NewsController::class, 'bulkDelete'])->name('news.bulk-delete');
    
    // ADMIN FAQ MANAGEMENT
    Route::prefix('faq')->name('faq.')->group(function () {
        // FAQ Categories
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/categories', [FaqController::class, 'categories'])->name('categories');
        Route::post('/categories', [FaqController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{category}', [FaqController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [FaqController::class, 'destroyCategory'])->name('categories.destroy');
        
        // FAQ Items
        Route::get('/items', [FaqController::class, 'items'])->name('items');
        Route::get('/items/create', [FaqController::class, 'createItem'])->name('items.create');
        Route::post('/items', [FaqController::class, 'storeItem'])->name('items.store');
        Route::get('/items/{item}/edit', [FaqController::class, 'editItem'])->name('items.edit');
        Route::put('/items/{item}', [FaqController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{item}', [FaqController::class, 'destroyItem'])->name('items.destroy');
        Route::post('/items/bulk-delete', [FaqController::class, 'bulkDeleteItems'])->name('items.bulk-delete');
    });
    
    // ADMIN CONTACT MESSAGES
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'adminIndex'])->name('index');
        Route::get('/{message}', [ContactController::class, 'adminShow'])->name('show');
        Route::post('/{message}/mark-read', [ContactController::class, 'markAsRead'])->name('mark-read');
        Route::post('/{message}/reply', [ContactController::class, 'reply'])->name('reply');
        Route::delete('/{message}', [ContactController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-delete', [ContactController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/bulk-mark-read', [ContactController::class, 'bulkMarkRead'])->name('bulk-mark-read');
    });
    
    // ADMIN USER MANAGEMENT
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', function() {
            return Inertia::render('Admin/Users/Index', [
                'users' => \App\Models\User::with('tournaments')
                    ->latest()
                    ->paginate(20)
                    ->withQueryString()
            ]);
        })->name('index');
        
        Route::get('/{user}', function(\App\Models\User $user) {
            return Inertia::render('Admin/Users/Show', [
                'user' => $user->load(['tournaments', 'contactMessages'])
            ]);
        })->name('show');
    });
    
    // ADMIN SETTINGS
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function() {
            return Inertia::render('Admin/Settings/Index');
        })->name('index');
        
        Route::get('/gaming', function() {
            return Inertia::render('Admin/Settings/Gaming', [
                'supported_games' => config('gaming.supported_games', []),
                'tournament_types' => config('gaming.tournament_types', []),
                'gaming_platforms' => config('gaming.platforms', [])
            ]);
        })->name('gaming');
    });
});

// API Routes for Gaming Features
Route::middleware(['auth:sanctum'])->prefix('api')->name('api.')->group(function () {
    // Gaming Stats API
    Route::get('/gaming-stats', [ProfileController::class, 'getGamingStats'])->name('gaming-stats');
    Route::get('/leaderboard/{game?}', [ProfileController::class, 'getLeaderboard'])->name('leaderboard');
    
    // Tournament API (for future expansion)
    Route::prefix('tournaments')->name('tournaments.')->group(function () {
        Route::get('/upcoming', function() {
            return response()->json(['tournaments' => []]);
        })->name('upcoming');
        Route::get('/live', function() {
            return response()->json(['tournaments' => []]);
        })->name('live');
    });
});

// Gaming-specific public routes
Route::prefix('gaming')->name('gaming.')->group(function () {
    Route::get('/leaderboard', function() {
        return Inertia::render('Gaming/Leaderboard', [
            'games' => config('gaming.supported_games', []),
            'leaderboard_data' => []
        ]);
    })->name('leaderboard');
    
    Route::get('/tournaments', function() {
        return Inertia::render('Gaming/Tournaments', [
            'upcoming_tournaments' => [],
            'live_tournaments' => [],
            'past_tournaments' => []
        ]);
    })->name('tournaments');
    
    Route::get('/guides', function() {
        return Inertia::render('Gaming/Guides');
    })->name('guides');
});

// Mobile API routes (for future mobile app)
Route::prefix('mobile-api')->name('mobile-api.')->group(function () {
    Route::post('/register-device', function(\Illuminate\Http\Request $request) {
        // Mobile device registration for push notifications
        return response()->json(['status' => 'success']);
    })->name('register-device');
});

// Fallback route for SPA behavior
Route::fallback(function () {
    return Inertia::render('Errors/404');
});

require __DIR__.'/auth.php';
