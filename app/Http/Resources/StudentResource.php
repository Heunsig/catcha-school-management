<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon;

class StudentResource extends JsonResource
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
            'full_name' => $this->full_name,
            'type' => $this->type,
            'status' => $this->status,
            // 'date_of_birth' => $this->date_of_birth,
            'created_at' => $this->created_at,
            'hidden_created_at' => Carbon::parse($this->created_at)->format('YmdHis')
        ];
    }
}
