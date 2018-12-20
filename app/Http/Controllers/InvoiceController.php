<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Payment;
use Carbon;
use PDF;
use App\Http\Resources\InvoiceResource;
class InvoiceController extends Controller
{

    public function list()
    {
        $invoices = Payment::with(['product', 'payment_method'])->get();


        // return response()->json($invoices);
        return response()->json(InvoiceResource::collection($invoices));
    }


    public function add(Request $request) 
    {

        DB::beginTransaction();

        try {
            $payment = new Payment();
            $payment->student_id = $request->student_id;
            $payment->payment_method_key = $request->payment_method['method_key'];
            $payment->status = $request->status;
            $payment->payment_date = Carbon::now();
            $payment->note = $request->note;
            $payment->created_by = $request->user()->id;
            $payment->updated_by = $request->user()->id;

            $payment->save();

            if ($request->payment_method['method_key'] === 'CC') {
                $payment->credit_card_information()->create([
                    'card_numbers' => $request->payment_method['detail']['digits'],
                    'name_on_card' => $request->payment_method['detail']['name'],
                    'expiration_month' => $request->payment_method['detail']['month'],
                    'expiration_year' => $request->payment_method['detail']['year']
                ]);
            }

            for($i = 0 ; $i < count($request->invoice_items) ; $i++) {
                $payment->product()->attach($request->invoice_items[$i]['product_id'], [
                    'price' => $request->invoice_items[$i]['price'],
                    'quantity' => $request->invoice_items[$i]['quantity'],
                    'start_date' => $request->invoice_items[$i]['start_date'],
                    'completion_date' => $request->invoice_items[$i]['completion_date'],
                    'note' => $request->invoice_items[$i]['note']
                ]);
            }

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }

        
        $new_payment = Payment::where('id', $payment->id)->with(['product', 'payment_method'])->first();

        return response()->json(new InvoiceResource($new_payment));
    }

    public function change_status(Request $request, $invoice_id)
    {
        $payment = Payment::where('id', $invoice_id)->with(['product', 'payment_method'])->first();
        $payment->status = $request->status;
        $payment->updated_by = $request->user()->id;
        $payment->save();

        return response()->json(new InvoiceResource($payment));
    }

    public function delete(Request $request, $invoice_id)
    {
        $payment = Payment::where('id', $invoice_id)->first();
        $payment->deleted_at = Carbon::now();
        $payment->deleted_by = $request->user()->id;
        $payment->save();

        return response()->json(new InvoiceResource($payment));
    }


    public function refund(Request $request, $invoice_id)
    {   
        DB::beginTransaction();
        try {
            $payment = Payment::where('id', $invoice_id)->first();

            for ($i = 0 ; $i < count($request->refunded_product_ids) ; $i++) {
                $payment->product()->newPivotStatement()
                                   ->where('id', $request->refunded_product_ids[$i])
                                   ->update([
                                        'is_refunded' => true
                                    ]);
            }

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }
            
        $payment = Payment::where('id', $invoice_id)->with(['product', 'payment_method'])->first();

        return response()->json(new InvoiceResource($payment));
    }

    public function pdf_test()
    {
        // Fetch all customers from database
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf');
        // If you want to store the generated pdf to the server then you can use the store function
        // $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->stream();
    }
}
