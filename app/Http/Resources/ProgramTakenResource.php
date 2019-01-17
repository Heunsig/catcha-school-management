<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramTakenResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'start_date'=> $this->pivot->start_date,
            'completion_date' => $this->pivot->completion_date,
        ];
    }
}
