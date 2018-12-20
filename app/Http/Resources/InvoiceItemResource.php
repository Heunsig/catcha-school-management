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
            'id' => $this->pivot->id,
            'product_name' => $this->name,
            'product_id' => $this->id,
            'is_refunded' => $this->pivot->is_refunded,
            'start_date' => $this->pivot->start_date,
            'completion_date' => $this->pivot->completion_date,
            'price' => $this->pivot->price,
            'quantity' => $this->pivot->quantity,
            'note' => $this->pivot->note
        ];
    }
}
