<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\ContactInfoTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ContactInfoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact-info index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacInfos = ContactInfo::all();
        return view('backend.contact-info.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('contact-info create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.contact-info.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('contact-info create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $contacInfo = new ContactInfo();
            $contacInfo->icon = $request->icon;
            $contacInfo->save();
            foreach (active_langs() as $active_lang) {
                $translation = new ContactInfoTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->content = $request->content[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->contacInfo_id = $contacInfo->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.contact-info.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.contact-info.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('contact-info edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacInfo = ContactInfo::findOrFail($id);
        return view('backend.contact-info.update', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('contact-info edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacInfo = ContactInfo::findOrFail($id);
        $contacInfo->update([
            'icon'=>$request->icon
        ]);
        try {
            DB::transaction(function () use ($request, $contacInfo) {
                foreach (active_langs() as $lang) {
                    $contacInfo->translate($lang->code)->title = $request->title[$lang->code];
                    $contacInfo->translate($lang->code)->content = $request->content[$lang->code];
                    $contacInfo->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $contacInfo->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.contact-info.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.contact-info.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('contact-info delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            ContactInfo::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.contact-info.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.contact-info.index');
        }
    }
}
