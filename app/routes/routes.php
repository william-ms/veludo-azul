<?php

use app\library\routes\Route;
use app\controllers\HomeController;
use app\controllers\ServiceController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/service/[0-9]+', [ServiceController::class, 'index']);
Route::get('/service/update/[a-z]+', [ServiceController::class, 'update']);
Route::get('/service/create', [ServiceController::class, 'create']);
Route::post('/service', [ServiceController::class, 'store']);
Route::get('/destroy/service/[0-9]+', [ServiceController::class, 'destroy']);