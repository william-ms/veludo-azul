<?php

use app\library\routes\Route;
use app\controllers\HomeController;
use app\controllers\ServiceController;
use app\controllers\CalendarController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/service/[0-9]+', [ServiceController::class, 'index']);
Route::get('/service/create', [ServiceController::class, 'create']);
Route::post('/service', [ServiceController::class, 'store']);
Route::get('/service/edit/[a-z]+', [ServiceController::class, 'edit']);
Route::post('/service/update', [ServiceController::class, 'update']);
Route::get('/destroy/service/[0-9]+', [ServiceController::class, 'destroy']);

Route::get('/calendar', [CalendarController::class, 'index']);
Route::post('/calendar/update', [CalendarController::class, 'update']);