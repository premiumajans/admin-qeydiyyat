<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PackageName;
use App\Models\PackageNameTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('package-name index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageNames = PackageName::all();
        return view('backend.package-name.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('package-name create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.package-name.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('package-name create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $packageName = new PackageName();
            $packageName->save();
            foreach (active_langs() as $active_lang) {
                $translation = new PackageNameTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->price = $request->price[$active_lang->code]." ".$request->exchange;
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->package_name_id = $packageName->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.package-name.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.package-name.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('package-name edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageName = PackageName::findOrFail($id);
        return view('backend.package-name.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('package-name edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageName = PackageName::findOrFail($id);
        try {
            DB::transaction(function () use ($request, $packageName) {
                foreach (active_langs() as $lang) {
                    $packageName->translate($lang->code)->title = $request->title[$lang->code];
                    $packageName->translate($lang->code)->price = $request->price[$lang->code];
                    $packageName->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $packageName->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.package-name.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.package-name.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('package-name delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            PackageName::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.package-name.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.package-name.index');
        }
    }
}
