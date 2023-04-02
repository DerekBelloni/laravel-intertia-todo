<?php

use App\Http\Controllers\ArchivedTaskController;
use App\Http\Controllers\ArchiveTaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkChecklistController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// WorkChecklist
Route::middleware('auth')->group(function () {
    Route::get('/WorkChecklist', [WorkChecklistController::class, 'index']);
    Route::post('/WorkChecklist/Store', [WorkChecklistController::class, 'store']);
    Route::post('/WorkChecklist/Update', [WorkChecklistController::class, 'update']);
    Route::post('/WorkChecklist/Delete', [WorkChecklistController::class, 'delete']);
});

//Archived Task
Route::middleware('auth')->group(function () {
    Route::post('/ArchivedTask/Store', [ArchivedTaskController::class, 'store']);
});

require __DIR__.'/auth.php';
