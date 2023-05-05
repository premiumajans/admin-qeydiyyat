<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PackageContent;
use App\Models\PackageContentTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PackageComponentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('package-content index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageContents = PackageContent::all();
        return view('backend.package-content.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('package-content create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.package-content.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('package-content create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $packageContent = new PackageContent();
            $packageContent->save();
            foreach (active_langs() as $active_lang) {
                $translation = new PackageContentTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->package_content_id = $packageContent->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.package-content.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.package-content.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('package-content edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageContent = PackageContent::findOrFail($id);
        return view('backend.package-content.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('package-content edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageContent = PackageContent::findOrFail($id);
        try {
            DB::transaction(function () use ($request, $packageContent) {
                foreach (active_langs() as $lang) {
                    $packageContent->translate($lang->code)->title = $request->title[$lang->code];
                    $packageContent->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $packageContent->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.package-content.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.package-content.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('package-content delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            PackageContent::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.package-content.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.package-content.index');
        }
    }
}
