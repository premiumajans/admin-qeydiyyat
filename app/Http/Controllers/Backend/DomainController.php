<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DomainController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('domain index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $domains = Domain::latest()->get();
        return view('backend.domain.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('domain create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.domain.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('domain create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        /* try { */
            Domain::create([
                'title'=>$request->title,
                'price'=>$request->price,
                'domain_time_increase_price'=>$request->domain_time_increase_price,
                'transfer_price'=>$request->transfer_price,
                'exchange'=>$request->exchange,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.domain.index'));
        /* } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.domain.index'));
        } */
    }

    public function edit($id)
    {
        abort_if(Gate::denies('domain edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $domain = Domain::findOrFail($id);
        return view('backend.domain.update', get_defined_vars());
    }

    public function update(Request $request, Domain $domain)
    {
        abort_if(Gate::denies('domain edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $domain->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'domain_time_increase_price'=>$request->domain_time_increase_price,
                'transfer_price'=>$request->transfer_price,
                'exchange'=>$request->exchange,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.domain.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.domain.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('domain delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Domain::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.domain.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.domain.index');
        }
    }
}
