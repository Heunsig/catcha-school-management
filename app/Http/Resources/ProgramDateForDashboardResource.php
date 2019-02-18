<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramDateForDashboardResource extends JsonResource
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
            'start_date' => $this->start_date,
            'completion_date' => $this->completion_date,
            // 'program' => $this->program->product->name,
            'program' => [
                'id' => $this->program->id,
                'name' => $this->program->product->name,
                'is_deleted' => ($this->program->deleted_at) ? true:false, 
            ],
            'student' => [
                'id' => $this->program->student->id,
                'email' => $this->program->student->email,
                'first_name' => $this->program->student->first_name,
                'full_name' => $this->program->student->full_name
            ]
        ];
    }
}
