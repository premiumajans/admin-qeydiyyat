<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('service index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $servicies = Service::all();
        return view('backend.service.index', get_defined_vars());
    }

    public function edit($id)
    {
        abort_if(Gate::denies('service edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = Service::findOrFail($id);
        return view('backend.update.service-update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('service edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = Service::findOrFail($id);
        try {
            DB::transaction(function () use ($request, $service) {
                foreach (active_langs() as $lang) {
                    $service->translate($lang->code)->title = $request->title[$lang->code];
                    $service->translate($lang->code)->content = $request->content[$lang->code];
                }
                $service->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.service.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.service.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('service delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Service::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.service.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.service.index');
        }
    }
}
