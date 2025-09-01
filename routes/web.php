<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('index');
})->name('home');

Route::get('/blog', function () {
    return Inertia::render('blog/index');
})->name('blogs');
Route::get('/blog/{slug}', function () {
    return Inertia::render('blog/slug');
})->name('blog');

Route::get('/portfolio', function (Request $request) {
    $perPage = $request->input('per_page', 10); // Get per_page from request, default to 10
    $filters = [];
    $paginated = Portfolio::paginate($perPage);

    return Inertia::render('portfolio/index', [
        'portfolios' => $paginated->items(),
        'pagination' => [
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'per_page' => $paginated->perPage(),
            'total' => $paginated->total(),
            'from' => $paginated->firstItem(),
            'to' => $paginated->lastItem(),
        ],
    ]);
})->name('portfolios');
Route::get('/portfolio/{slug}', function () {
    return Inertia::render('portfolio/slug');
})->name('portfolio');

Route::get('/about', function () {
    return Inertia::render('about');
})->name('about');

Route::prefix('admin')->group(function () {

    Route::resource('blog', BlogController::class)->only(['index']);
    Route::resource('portfolio', PortfolioController::class);

    Route::get('/', function () {
        return Inertia::render('admin/dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
