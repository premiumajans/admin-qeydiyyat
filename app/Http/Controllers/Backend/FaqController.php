<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class FaqController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('faq index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faqs = Faq::all();
        return view('backend.faq.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('faq create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.faq.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('faq create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $faq = new Faq();
            $faq->save();
            foreach (active_langs() as $active_lang) {
                $translation = new FaqTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->content = $request->content[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->faq_id = $faq->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.faq.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.faq.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('faq edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faq = Faq::findOrFail($id);
        return view('backend.faq.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('faq edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faq = Faq::findOrFail($id);
        try {
            DB::transaction(function () use ($request, $faq) {
                foreach (active_langs() as $lang) {
                    $faq->translate($lang->code)->title = $request->title[$lang->code];
                    $faq->translate($lang->code)->content = $request->content[$lang->code];
                }
                $faq->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.faq.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.faq.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('faq delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Faq::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.faq.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.faq.index');
        }
    }
}
