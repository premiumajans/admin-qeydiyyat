<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PartnerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('partner index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $partners = Partner::latest()->get();
        return view('backend.partner.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('partner create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.partner.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('partner create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Partner::create([
                'image'=>upload('partners', $request->file('image')),
                'link'=>$request->link,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.partner.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.partner.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('partner edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $partner = Partner::findOrFail($id);
        return view('backend.partner.update', get_defined_vars());
    }

    public function update(Request $request, Partner $partner)
    {
        abort_if(Gate::denies('partner edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            if ($request->hasFile('image')) {
                unlink((public_path($partner->image)));
                $partner->image = upload('partners', $request->file('image'));
            }
            $partner->update([
                'link'=>$request->link,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.partner.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.partner.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('partner delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(Partner::find($id)->image);
            Partner::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.partner.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.partner.index');
        }
    }
}
