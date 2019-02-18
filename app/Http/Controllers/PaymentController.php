<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Payment;
use App\PaymentDetail;
use App\PaymentDetailAttribute;
use Carbon;


use App\Http\Resources\InvoiceResource;

class PaymentController extends Controller
{

    public function list()
    {
        $payments = Payment::whereNull('deleted_at')->get();

        return response()->json(InvoiceResource::collection($payments));
    }

    /*
     * Need refactoring
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $test = null;
        
        try {

            $payment = new Payment();
            $payment->student_id = $request->student_id;
            $payment->payment_method_key = $request->method_key;
            $payment->status = $request->status;
            $payment->payment_date = Carbon::now();
            $payment->note = $request->note;
            $payment->created_at = Carbon::now();
            $payment->created_by = $request->user()->id;
            $payment->updated_at = Carbon::now();
            $payment->updated_by = $request->user()->id;

            $payment->save();

            if ($request->method_key === 'CC') {
                $expiration_date = $request->payment_method_details['date'];
                $splited_date = explode('/', $expiration_date);

                $payment->credit_card_information()->create([
                    'card_numbers' => $request->payment_method_details['digits'],
                    'name_on_card' => $request->payment_method_details['name'],
                    'expiration_month' => $splited_date[0],
                    'expiration_year' => $splited_date[1]
                ]);
            }

            $items = [];
            for($i = 0 ; $i < count($request->items) ; $i++) {
                $item = new PaymentDetail();
                $item->product_id = $request->items[0]['product_id'][count($request->items[0]['product_id']) - 1];
                $item->price = $request->items[$i]['price'];
                $item->quantity = $request->items[$i]['quantity'];
                $item->week = $request->items[$i]['week'];
                $item->note = $request->items[$i]['note'];

                $items[] = $item;
            }

            $payment->payment_detail()->saveMany($items);

            for ($i = 0 ; $i < count($items) ; $i++) {
                $attributes = [];
                for ($j = 0 ; $j < count($request->items[$i]['attributes']) ; $j++) {
                    $attribute = new PaymentDetailAttribute();
                    $attribute->attribute_id = $request->items[$i]['attributes'][$j]['attribute_id'];
                    $attribute->attribute_value_id = $request->items[$i]['attributes'][$j]['attribute_value_id'];
                    
                    $attributes[] = $attribute;                    
                }

                $items[$i]->attribute()->saveMany($attributes);
            }

            DB::commit();
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }

        $stored_payment = Payment::where('id', $payment->id)->first();

        return response()->json(new InvoiceResource($stored_payment));
    }

    public function destroy(Request $request, $payment_id)
    {
        $payment = Payment::where('id', $payment_id)->first();
        $payment->deleted_at = Carbon::now();
        $payment->deleted_by = $request->user()->id;
        $payment->save();

        $removed_payment = Payment::where('id', $payment_id)->first();

        return response()->json(new InvoiceResource($removed_payment));
    }


    public function change_status(Request $request, $payment_id)
    {
        $payment = Payment::where('id', $payment_id)->first();
        $payment->status = $request->status;
        $payment->updated_at = Carbon::now();
        $payment->updated_by = $request->user()->id;
        $payment->save();

        $updated_payment = Payment::where('id', $payment_id)->first();

        return response()->json(new InvoiceResource($updated_payment));
    }

}
