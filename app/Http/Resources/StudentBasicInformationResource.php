<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentBasicInformationResource extends JsonResource
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
            'type' => [
                'name' => $this->type->key,
                'id' => $this->type->value
            ],
            'status' => [
                'name' => $this->status->key,
                'id' => $this->status->value
            ],
            'email' => $this->email,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'nickname' => $this->nickname,
            'date_of_birth' => $this->date_of_birth,
            'country_of_birth' => $this->country_of_birth,
            'country_of_citizenship' => $this->country_of_citizenship,
            'city_of_birth' => $this->city_of_birth,
            'sex' => $this->sex,
            'note' => $this->note
        ];
    }
}
