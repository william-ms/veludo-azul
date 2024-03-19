<?php

use app\library\routes\Route;
use app\controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);