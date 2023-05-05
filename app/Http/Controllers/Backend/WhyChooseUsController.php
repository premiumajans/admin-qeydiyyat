<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use App\Models\WhyChooseUsTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('why-choose-us index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $why_choose_us_all = WhyChooseUs::all();
        return view('backend.why-choose-us.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('why-choose-us create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.why-choose-us.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('why-choose-us create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $why_choose_us = new WhyChooseUs();
            $why_choose_us->icon = $request->icon;
            $why_choose_us->save();
            foreach (active_langs() as $active_lang) {
                $translation = new WhyChooseUsTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->content = $request->content[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->why_choose_us_id = $why_choose_us->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.why-choose-us.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.why-choose-us.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('why-choose-us edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $why_choose_us = WhyChooseUs::findOrFail($id);
        return view('backend.why-choose-us.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('why-choose-us edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $why_choose_us = WhyChooseUs::findOrFail($id);
        $why_choose_us->update([
            'icon'=>$request->icon
        ]);
        try {
            DB::transaction(function () use ($request, $why_choose_us) {
                foreach (active_langs() as $lang) {
                    $why_choose_us->translate($lang->code)->title = $request->title[$lang->code];
                    $why_choose_us->translate($lang->code)->content = $request->content[$lang->code];
                    $why_choose_us->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $why_choose_us->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.why-choose-us.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.why-choose-us.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('why-choose-us delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            WhyChooseUs::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.why-choose-us.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.why-choose-us.index');
        }
    }
}
