<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentForDashboardResource extends JsonResource
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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'type' => 'F1',
            // 'status' => $this->status,
            'birth_day' => '1990-12-26',
            'created_at' => $this->created_at->format('Y-m-d'),
            // 'hidden_created_at' => $this->created_at->format('YmdHis')
        ];
    }
}
