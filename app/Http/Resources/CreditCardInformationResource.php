<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardInformationResource extends JsonResource
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
            'digits' => $this->card_numbers,
            'name' => $this->name_on_card,
            'month' => $this->expiration_month,
            'year' => $this->expiration_year
        ];
    }
}
