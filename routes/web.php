<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', GuestHomeController::class)->name('guest.home');

// PER CREARE LE ROTTE PER I GUEST GUARDA LA LIVE DEL 20/03/2024 DAL MINUTO 02:00:00

Route::get('/admin', AdminHomeController::class)->middleware(['auth'])->name('admin.home');

Route::get('/admin/projects', [AdminProjectController::class, 'index'])->name('admin.projects.index')->middleware('auth');
Route::get('/admin/projects/create', [AdminProjectController::class, 'create'])->name('admin.projects.create')->middleware('auth');
Route::get('/admin/projects/{project}', [AdminProjectController::class, 'show'])->name('admin.projects.show')->middleware('auth');
Route::get('/admin/projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('admin.projects.edit')->middleware('auth');
Route::post('/admin/projects', [AdminProjectController::class, 'store'])->name('admin.projects.store')->middleware('auth');
Route::put('/admin/projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update')->middleware('auth');
Route::delete('/admin/projects/{project}', [AdminProjectController::class, 'destroy'])->name('admin.projects.destroy')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
