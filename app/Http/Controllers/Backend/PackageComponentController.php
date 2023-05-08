<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ComponentTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PackageComponentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('package-components index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageComponents = Component::all();
        return view('backend.package-components.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('package-components create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.package-components.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('package-components create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $packageComponent = new Component();
            $packageComponent->save();
            foreach (active_langs() as $active_lang) {
                $translation = new ComponentTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->component_id = $packageComponent->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.package-components.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.package-components.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('package-components edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageComponent = Component::findOrFail($id);
        return view('backend.package-components.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('package-components edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageComponent = Component::findOrFail($id);
        try {
            DB::transaction(function () use ($request, $packageComponent) {
                foreach (active_langs() as $lang) {
                    $packageComponent->translate($lang->code)->title = $request->title[$lang->code];
                }
                $packageComponent->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.package-components.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.package-components.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('package-components delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Component::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.package-components.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.package-components.index');
        }
    }
}
