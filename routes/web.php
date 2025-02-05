<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

// //Auth Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeUserData']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard'); // User Dashboard
    Route::get('/tasks', [DashboardController::class, 'index']);
    Route::post('/tasks/save', [DashboardController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [DashboardController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [DashboardController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [DashboardController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
