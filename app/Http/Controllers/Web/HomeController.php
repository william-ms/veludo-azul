<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\ServiceTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ServiceTrait;

    public function index(Request $request)
    {
        $Services = Service::with('client')->whereDate('delivery_date', $request->date ?? now()->today())->get();

        return inertia('Web/HomeWeb', [
            'Services' => $Services,
            'ServiceStatus' => $this->ServiceStatus
        ]);
    }
}
