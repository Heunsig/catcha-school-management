<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class ClassBelongingToStudentResource extends JsonResource
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
            'start_date' => $this->pivot->start_date,
            'completion_date' => $this->pivot->completion_date,
            'timestamps' => [
                'created_at' => $this->pivot->created_at->format('Y-m-d H:i:s'),
                'created_by' => new AdministratorResource(User::where('id', $this->pivot->created_by)->first()),
                'updated_at' => $this->pivot->updated_at->format('Y-m-d H:i:s'),
                'updated_by' => new AdministratorResource(User::where('id', $this->pivot->updated_by)->first()),
                'deleted_at' => $this->pivot->deleted_at,
                'deleted_by' => new AdministratorResource(User::where('id', $this->pivot->deleted_by)->first())
            ]
        ];
    }

    
}
