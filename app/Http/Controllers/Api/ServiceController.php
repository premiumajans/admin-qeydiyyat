<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $servicies = Service::all();
        return response()->json($servicies);
    }

    public function show(Service $service)
    {
        return response()->json($service);
    }
}
