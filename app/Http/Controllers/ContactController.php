<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

use Carbon;
use App\Http\Resources\ContactResource;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->student_id = $request->student_id;
        $contact->country_code = $request->country_code;
        $contact->number = $request->number;
        $contact->category = strtolower($request->category);
        $contact->created_at = Carbon::now();
        $contact->created_by = $request->user()->id;
        $contact->updated_at = Carbon::now();
        $contact->updated_by = $request->user()->id;
        $contact->save();

        $new_contact = Contact::where('id', $contact->id)->first();

        return response()->json(new ContactResource($new_contact));
    }

    public function destroy(Request $request, $contact_id)
    {
        $contact = Contact::where('id', $contact_id)->first();
        $contact->deleted_at = Carbon::now();
        $contact->deleted_by = $request->user()->id;
        $contact->save();

        return response()->json('success');
    }
}