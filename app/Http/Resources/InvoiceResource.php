<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
// use App\Http\Resources\InvoiceItemResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'payment_date' => $this->payment_date,
            'status' => $this->status,
            'note' => $this->note,
            'payment_method_key' => $this->payment_method->key,
            'payment_method' => $this->payment_method->method,
            'payment_method_detail' => $this->when($this->payment_method->key==='CC',  new CreditCardInformationResource($this->credit_card_information()->first())),
            'invoice_items' => InvoiceItemResource::collection($this->product),
            'created_at' => $this->created_at,
            'created_by' => new UserResource(User::where('id', $this->created_by)->first()),
            'updated_at' => $this->updated_at,
            'updated_by' => new UserResource(User::where('id', $this->updated_by)->first()),
            'deleted_at' => $this->deleted_at,
            'deleted_by' => new UserResource(User::where('id', $this->deleted_by)->first()),
        ];
    }
}
