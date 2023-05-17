<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Domain;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::all();
        return response()->json($domains);
    }
}
