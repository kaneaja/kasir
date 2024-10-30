<?php

use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');


Route::prefix('admin')-> middleware(['auth', isAdmin::class])-> group(function(){

    //kasir
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/kasir', [CashierController::class, 'index'])->name('cashiers.index');
    Route::get('kasir/create', [CashierController::class, 'create'])->name('cashiers.create');
    Route::get('/kasir/{id}', [CashierController::class, 'destroy'])->name('cashiers.destroy');
    Route::put('/kasir/{id}', [CashierController::class, 'update'])->name('cashiers.update');
    Route::get('/kasir/{id}/edit', [CashierController::class, 'edit'])->name('cashiers.edit');

    Route::post('/kasir', [CashierController::class, 'store'])->name('cashiers.store');
    //menu
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::get('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');

    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
});

auth::routes(['register' =>false]);