<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->product->name,
            'week' => $this->week,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'note' => $this->note,
            'attributes' => PaymentDetailAttributeResource::collection($this->attribute)
            // 'is_refunded' => $this->is_refunded
        ];
        // return [
        //     'id' => $this->pivot->id,
        //     'product_name' => $this->name,
        //     'product_id' => $this->id,
        //     'is_refunded' => $this->pivot->is_refunded,
        //     'start_date' => $this->pivot->start_date,
        //     'completion_date' => $this->pivot->completion_date,
        //     'price' => $this->pivot->price,
        //     'quantity' => $this->pivot->quantity,
        //     'note' => $this->pivot->note
        // ];
    }
}
