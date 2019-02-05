<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmergencyContact;
use Carbon;
use App\Http\Resources\EmergencyContactResource;

class EmergencyContactController extends Controller
{
    public function store(Request $request)
    {
        $emergency_contact = new EmergencyContact();
        $emergency_contact->student_id = $request->student_id;
        $emergency_contact->name = $request->name;
        $emergency_contact->relationship = $request->relationship;
        $emergency_contact->country_code = $request->country_code;
        $emergency_contact->number = $request->number;
        $emergency_contact->category = $request->category;
        $emergency_contact->email = $request->email;
        $emergency_contact->address_line1 = $request->address_line1;
        $emergency_contact->address_line2 = $request->address_line2;
        $emergency_contact->city = $request->city;
        $emergency_contact->state = $request->state;
        $emergency_contact->postal_code = $request->postal_code;
        $emergency_contact->country = $request->country;
        $emergency_contact->created_at = Carbon::now();
        $emergency_contact->created_by = $request->user()->id;
        $emergency_contact->updated_at = Carbon::now();
        $emergency_contact->updated_by = $request->user()->id;
        $emergency_contact->save();

        return response()->json('success');
    }

    public function update(Request $request, $emergency_contact_id)
    {
        $emergency_contact = EmergencyContact::where('id', $emergency_contact_id)->first();
        $emergency_contact->name = $request->name;
        $emergency_contact->relationship = $request->relationship;
        $emergency_contact->country_code = $request->country_code;
        $emergency_contact->number = $request->number;
        $emergency_contact->category = $request->category;
        $emergency_contact->email = $request->email;
        $emergency_contact->address_line1 = $request->address_line1;
        $emergency_contact->address_line2 = $request->address_line2;
        $emergency_contact->city = $request->city;
        $emergency_contact->state = $request->state;
        $emergency_contact->postal_code = $request->postal_code;
        $emergency_contact->country = $request->country;
        $emergency_contact->updated_at = Carbon::now();
        $emergency_contact->updated_by = $request->user()->id;
        $emergency_contact->save();

        $updated_emergency_contact = EmergencyContact::where('id', $emergency_contact_id)->first();

        return response()->json(new EmergencyContactResource($updated_emergency_contact));
    }
}
