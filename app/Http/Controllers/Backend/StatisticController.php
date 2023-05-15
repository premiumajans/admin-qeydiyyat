<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use App\Models\StatisticTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StatisticController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('statistic index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $statistics = Statistic::all();
        return view('backend.statistic.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('statistic create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.statistic.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('statistic create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $statistic = new Statistic();
            $statistic->number = $request->number;
            $statistic->save();
            foreach (active_langs() as $active_lang) {
                $translation = new StatisticTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->statistic_id = $statistic->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.statistic.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.statistic.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('statistic edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $statistic = Statistic::findOrFail($id);
        return view('backend.statistic.update', get_defined_vars());
    }

    public function update(Request $request, Statistic $statistic /* $id */)
    {
        abort_if(Gate::denies('statistic edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        /* $statistic = Statistic::findOrFail($id);
        $statistic = Statistic::findOrFail($id); */
        $statistic->number = $request->number;
        try {
            DB::transaction(function () use ($request, $statistic) {
                foreach (active_langs() as $lang) {
                    $statistic->translate($lang->code)->title = $request->title[$lang->code];
                }
                $statistic->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.statistic.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.statistic.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('statistic delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Statistic::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.statistic.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.statistic.index');
        }
    }
}
