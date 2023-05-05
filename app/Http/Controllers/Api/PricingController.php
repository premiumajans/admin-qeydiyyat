<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriceCategory;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $servicies = PriceCategory::all();
        return response()->json($servicies);
    }

    public function show(PriceCategory $priceCategory)
    {
        return response()->json($priceCategory);
    }
}
