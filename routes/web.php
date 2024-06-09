<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingListController;
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

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [ShoppingListController::class, 'index'])->name('dashboard');
    Route::get('/lists/{listId}', [ShoppingListController::class, 'get'])->name('lists.get');
    Route::post('/lists/{listId}/item/create', [ShoppingListController::class, 'create'])->name('lists.create');
    Route::delete('/lists/{listId}/{itemId}/delete', [ShoppingListController::class, 'delete'])->name('lists.delete');
    Route::patch('/lists/{listId}/{itemId}/toggle', [ShoppingListController::class, 'toggle'])->name('lists.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
