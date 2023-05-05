<?php

namespace App\Http\Controllers\Api;

use App\Models\WhyChooseUs;
use App\Http\Controllers\Controller;

class WhyChooseUsController extends Controller
{

    public function index()
    {
        $whyChooseUs = WhyChooseUs::all();
        return response()->json($whyChooseUs);
    }

    public function show($id)
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        return response()->json($whyChooseUs);
    }
}
