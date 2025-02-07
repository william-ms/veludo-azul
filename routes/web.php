<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\ServiceTypeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'client', 'as' => 'client.'], function() {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/', [ClientController::class, 'store'])->name('store');
        Route::put('/{client}', [ClientController::class, 'update'])->name('update');
        Route::get('/get/{client}', [ClientController::class, 'get'])->name('get');
        Route::get('/{client}', [ClientController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'service/type', 'as' => 'service.type.'], function() {
        Route::get('/', [ServiceTypeController::class, 'index'])->name('index');
        Route::get('/create', [ServiceTypeController::class, 'create'])->name('create');
        Route::post('/', [ServiceTypeController::class, 'store'])->name('store');
        Route::get('/{service_type}/edit', [ServiceTypeController::class, 'edit'])->name('edit');
        Route::put('/{service_type}', [ServiceTypeController::class, 'update'])->name('update');
        Route::delete('/{service_type}', [ServiceTypeController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'service', 'as' => 'service.'], function() {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
    });
});

require __DIR__.'/auth.php';
