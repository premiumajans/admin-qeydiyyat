<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriceCategory;

class PriceCategoryController extends Controller
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
