<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTranslation;
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
        $services = Service::all();
        return view('backend.service.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('service create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.service.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('service create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $service = new Service();
            $service->icon = $request->icon;
            $service->save();
            foreach (active_langs() as $active_lang) {
                $translation = new ServiceTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->content = $request->content[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->service_id = $service->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.service.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.service.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('service edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = Service::findOrFail($id);
        return view('backend.service.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('service edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = Service::findOrFail($id);
        $service->icon = $request->icon;
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
