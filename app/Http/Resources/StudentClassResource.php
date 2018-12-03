<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class StudentClassResource extends JsonResource
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
            'classinfo_id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'group' => $this->pivot->group,
            'start_date' => $this->pivot->start_date,
            'completion_date' => $this->pivot->completion_date,
            'created_at' => $this->pivot->created_at,
            'created_by' => new UserResource(User::where('id', $this->pivot->created_by)->first()),
            'updated_at' => $this->pivot->updated_at,
            'updated_by' => new UserResource(User::where('id', $this->pivot->updated_by)->first()),
            'deleted_at' => $this->pivot->deleted_at,
            'deleted_by' => new UserResource(User::where('id', $this->pivot->deleted_by)->first()),
        ];
    }
}
