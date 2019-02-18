<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaveForDashboardResource extends JsonResource
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
            'leave_type' => $this->leave_type->value,
            'start_date' => $this->start_date,
            'completion_date' => $this->completion_date,
            // 'associated_programs' => ProgramSimpleResource::collection($this->program),
            'student' => [
                'id' => $this->student->id, 
                'email' => $this->student->email,
                'first_name' => $this->student->first_name,
                'full_name' => $this->student->full_name
            ]
        ];
    }
}
