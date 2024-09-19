<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\Admin;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\table;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/table', function () {
    return view('admin/table');
})->middleware(['auth', 'verified'])->name('table');



Route::get("/dashboard", [App\Http\Controllers\AdminController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth','admin');

Route::get('/item/table', [ItemController::class, 'cerate'])->name('item.table');
Route::post('/admin', [ItemController::class, 'store'])->name('item.store');

Route::get('/admin/create', [ItemController::class, 'create'])->name('admin.create');

Route::post('/about',[ItemController::class, 'store'])->name('admin.store');

Route::get('admin/about', [ItemController::class, 'index'])->name('admin.about');

Route::get('/admin{id}/edit', [ItemController::class, 'edit'])->name('admin.edit');
Route::put('/admin{id}', [ItemController::class, 'update'])->name('admin.update');
Route::delete('/admin{id}', [ItemController::class, 'destroy'])->name('admin.update');
require __DIR__.'/auth.php';