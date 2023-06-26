<?php

use App\Http\Controllers\ArchivedTaskController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/Dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard');
});

// Projects
Route::middleware('auth')->group(function() {
    Route::post('/Project/Store', [ProjectController::class, 'store']);
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Checklist
Route::middleware('auth')->group(function () {
    Route::get('/Checklist', [ChecklistController::class, 'index'])->name('checklist.index');
    Route::post('/Checklist/Store', [ChecklistController::class, 'store']);
    Route::post('/Checklist/Update', [ChecklistController::class, 'update']);
    Route::post('/Checklist/Delete', [ChecklistController::class, 'delete']);
});

// Sub-tasks
Route::middleware('auth')->group(function () {
    Route::post('/Subtask/Store', [SubTaskController::class, 'store']);
    Route::post('/Subtask/Update', [SubTaskController::class, 'update']);
    Route::post('/Subtask/Delete', [SubTaskController::class, 'delete']);
});

//Archived Task
Route::middleware('auth')->group(function () {
    Route::get('/ArchivedTask', [ArchivedTaskController::class, 'index']);
    Route::post('/ArchivedTask/Store', [ArchivedTaskController::class, 'store']);
});

// Comments
Route::middleware('auth')->group(function () {
    Route::post('/Comments/Store', [CommentsController::class, 'store']);
});

require __DIR__.'/auth.php';













// Old
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
//