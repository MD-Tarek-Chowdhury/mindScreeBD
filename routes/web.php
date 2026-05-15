<?php

use App\Http\Controllers\AssessmentController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Route (View only)
Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');

Route::post('/assessment', [AssessmentController::class, 'store'])->name('assessment.store');
Route::get('/assessment', [AssessmentController::class, 'create'])->name('assessment.create');

Route::middleware(['auth', 'verified', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin/resources', [ResourceController::class, 'adminIndex'])->name('admin.resources');
    Route::post('/admin/resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::delete('/admin/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');
    Route::put('/admin/resources/{resource}', [ResourceController::class, 'update'])->name('resources.update');
});

require __DIR__.'/auth.php';
