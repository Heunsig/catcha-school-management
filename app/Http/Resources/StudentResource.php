<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'full_name' => $this->user->full_name,
            'email' => $this->user->email,
            'type' => 'F1',
            'status' => $this->status,
            'birth_day' => null,
            'created_at' => $this->user->created_at->format('m/d/Y'),
            'hidden_created_at' => $this->user->created_at->format('YmdHis')
        ];
    }
}
