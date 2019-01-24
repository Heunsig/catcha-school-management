<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class ClassInProgramResource extends JsonResource
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
            'name' => $this->classinfo->name,
            'start_date' => $this->start_date,
            'completion_date' => $this->completion_date,
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
