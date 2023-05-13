<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacts = Contact::latest()->get();
        return view('backend.contact.index', get_defined_vars());
    }

    public function show(Contact $contact)
    {
        abort_if(Gate::denies('contact show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contact->first();
        return view('backend.contact.show', get_defined_vars());
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('contact delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Contact::findOrFail($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.contact.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.contact.index');
        }
    }
}
