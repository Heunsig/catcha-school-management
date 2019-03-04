<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class ProgramResource extends JsonResource
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
            'name' => $this->product->name,
            'status' => $this->payment_detail->payment->status,
            'dates' => ProgramDateResource::collection($this->program_date),
            'classes' => ClassInProgramResource::collection($this->class->filter(function($value, $key){
                return $value['deleted_at'] === null;
            })),
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
