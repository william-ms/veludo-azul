<?php

use app\library\routes\Route;
use app\controllers\HomeController;
use app\controllers\ServiceController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/service/create', [ServiceController::class, 'create']);
Route::post('/service', [ServiceController::class, 'store']);