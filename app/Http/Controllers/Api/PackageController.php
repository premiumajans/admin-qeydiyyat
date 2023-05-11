<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $servicies = Package::with('component')->get();
        return response()->json($servicies);
    }
}
