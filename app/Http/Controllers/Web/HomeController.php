<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return inertia('Web/Home', [
            'Services' => [],
        ]);
    }
}
