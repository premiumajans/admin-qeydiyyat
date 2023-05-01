<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $aervicies = Service::all();
        return response()->json($aervicies);
    }

    public function show(Service $service)
    {
        //
    }

    public function edit(Service $service)
    {
        //
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
    }

    public function destroy(Service $service)
    {
        //
    }
}
