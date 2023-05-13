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
        $contactInfos = ContactInfo::all();
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
            ContactInfo::create([
                'title'=>$request->title,
                'link'=>$request->link,
            ]);
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
        $contactInfo = ContactInfo::findOrFail($id);
        return view('backend.contact-info.update', get_defined_vars());
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        abort_if(Gate::denies('contact-info edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $contactInfo->update([
                'title'=>$request->title,
                'link'=>$request->link,
            ]);
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
