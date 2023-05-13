<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:2|max:255|string',
                'email' => 'required|email|string',
                'phone' => 'required|max:255|string',
                'subject' => 'required|max:255|string',
                'message' => 'required|string',
            ]);

            Contact::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'subject'=>$request->subject,
                'message'=>$request->message,
            ]);
            return response()->json(['message' => __('messages.message')]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
