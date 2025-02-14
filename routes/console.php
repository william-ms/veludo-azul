<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('services:fresh', function() {
    DB::table('clients')->delete();
    DB::statement('ALTER TABLE clients AUTO_INCREMENT = 1');

    DB::table('services')->delete();
    DB::statement('ALTER TABLE services AUTO_INCREMENT = 1');

    DB::table('service_items')->delete();
    DB::statement('ALTER TABLE service_items AUTO_INCREMENT = 1');

    DB::table('service_types')->delete();
    DB::statement('ALTER TABLE service_types AUTO_INCREMENT = 1');

    Artisan::call('db:seed', [
        '--class' => 'DatabaseSeeder', 
    ]);
})->everyMinute();
