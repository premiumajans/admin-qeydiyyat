<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Package;
use App\Models\PackageTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('packages index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packages = Package::all();
        return view('backend.packages.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('packages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.packages.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('packages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $package = new Package();
            $package->most_popular = $request->has('most_popular') ? 1 : 0;
            $package->save();
            foreach (active_langs() as $active_lang) {
                $translation = new PackageTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->monthlyPrice = $request->monthlyPrice[$active_lang->code];
                $translation->annualyPrice = $request->annualyPrice[$active_lang->code];
                $translation->exchange = $request->exchange[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->package_id = $package->id;
                $translation->save();
                
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.packages.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.packages.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('packages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::findOrFail($id);
        return view('backend.packages.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('packages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::findOrFail($id);
        $package->most_popular = $request->has('most_popular') ? 1 : 0;
        try {
            DB::transaction(function () use ($request, $package) {
                foreach (active_langs() as $lang) {
                    $package->translate($lang->code)->title = $request->title[$lang->code];
                    $package->translate($lang->code)->monthlyPrice = $request->monthlyPrice[$lang->code];
                    $package->translate($lang->code)->annualyPrice = $request->annualyPrice[$lang->code];
                    $package->translate($lang->code)->exchange = $request->exchange[$lang->code];
                    $package->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $package->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.packages.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.packages.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('packages delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Package::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.packages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.packages.index');
        }
    }

    public function packageChoose($id)
    {
        abort_if(Gate::denies('packages index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::where('id', $id)
            ->with('component')
            ->first();
        $components = Component::with('package')->get();
        $package = Package::findOrFail($id);
        return view('backend.packages.show', get_defined_vars());
    }

    public function packageStore(Request $request)
    {
        abort_if(Gate::denies('packages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $records = $request->input('component_id');
            $data = [];

            foreach ($records as $record) {
                $data[] = ['package_id' => $request->package_id, 'component_id' => $record, 'created_at' => now()];
            }

            DB::table('package_components')
                ->where('package_id', $request->package_id)
                ->delete();

            DB::table('package_components')->upsert($data, ['package_id', 'component_id'], ['created_at']);

            alert()->success(__('messages.success'));
            return redirect()->route('backend.packages.index');
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect()->route('backend.packages.index');
        }
    }
}
