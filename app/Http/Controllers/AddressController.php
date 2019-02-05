<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

use Carbon;

use App\Http\Resources\AddressResource;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $address = new Address();
        $address->student_id = $request->student_id;
        $address->address_line1 = $request->address_line1;
        $address->address_line2 = $request->address_line2;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->postal_code = $request->postal_code;
        $address->country = $request->country;
        $address->category = $request->category;
        $address->created_at = Carbon::now();
        $address->created_by = $request->user()->id;
        $address->updated_at = Carbon::now();
        $address->updated_by = $request->user()->id;

        $address->save();

        $new_address = Address::where('id', $address->id)->first();

        return response()->json(new AddressResource($new_address));
    }

    public function update(Request $request, $address_id)
    {
        $address = Address::where('id', $address_id)->first();
        $address->address_line1 = $request->address_line1;
        $address->address_line2 = $request->address_line2;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->postal_code = $request->postal_code;
        $address->country = $request->country;
        $address->category = $request->category;
        $address->updated_at = Carbon::now();
        $address->updated_by = $request->user()->id;

        $address->save();

        $updated_address = Address::where('id', $address_id)->first();

        return response()->json(new AddressResource($updated_address));
    }

    public function destroy(Request $request, $address_id)
    {
        $address = Address::where('id', $address_id)->first();
        $address->deleted_at = Carbon::now();
        $address->deleted_by = $request->user()->id;
        $address->save();

        $destroyed_address = Address::where('id', $address_id)->first();
        return response()->json(new AddressResource($destroyed_address));
    }
}
