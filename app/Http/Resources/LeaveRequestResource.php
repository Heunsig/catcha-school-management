<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class LeaveRequestResource extends JsonResource
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
            'leave_type_id' => $this->leave_type->id,
            'leave_type' => $this->leave_type->name,
            'start_date' => $this->start_date,
            'completion_date' => $this->completion_date,
            'associated_programs' => ProgramSimpleResource::collection($this->program),
            'administration' => [
                'created_at' => $this->created_at,
                'created_by' => new AdministratorResource(User::where('id', $this->created_by)->first()),
                'updated_at' => $this->updated_at,
                'updated_by' => new AdministratorResource(User::where('id', $this->updated_by)->first()),
                'deleted_at' => $this->deleted_at,
                'deleted_by' => new AdministratorResource(User::where('id', $this->deleted_by)->first())
            ]
        ];
    }
}
