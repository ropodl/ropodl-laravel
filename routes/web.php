<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioTypeController;
use App\Http\Controllers\ProfileController;
use App\Models\Portfolio;
use App\Models\PortfolioType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('index');
})->name('home');

Route::get('/blog', function () {
    return Inertia::render('blog/index');
})->name('blogs');
Route::get('blog/{slug}', function () {
    return Inertia::render('blog/slug');
})->name('blog');

Route::get('portfolio', function (Request $request, Portfolio $portflio, PortfolioType $type) {
    $perPage = $request->integer('per_page', 10);
    $paginated = $portflio::query()
        ->where('portfolio_type_id', '!=', 1)
        ->whereStatus('published')
        ->with(['type:id,title,slug'])
        ->select('id', 'title', 'slug', 'portfolio_type_id')
        ->paginate($perPage);

    return Inertia::render('portfolio/index', [
        'portfolios' => $paginated->items(),
        // 'types' => $type::all(['id', 'title']),
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
Route::get('/portfolio/{portfolio:slug}', function (Request $request, Portfolio $portfolio) {
    return Inertia::render('portfolio/slug', ['portfolio' => $portfolio]);
})->name('guest.portfolios');

Route::get('/about', function () {
    return Inertia::render('about');
})->name('about');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    Route::resource('blog', BlogController::class);
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('portfolio-type', PortfolioTypeController::class);

    Route::get('/', function () {
        return Inertia::render('admin/dashboard');
    })->name('dashboard');

    // Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });
});

require __DIR__.'/auth.php';
