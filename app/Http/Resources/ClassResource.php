<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
{
    // private $classinfo_id;

    // public function __construct($resource, $classinfo_id)
    // {
    //     // Ensure you call the parent constructor
    //     parent::__construct($resource);
    //     $this->resource = $resource;
        
    //     $this->classinfo_id = $foo;
    // }

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
            'name' => $this->name,
            'description' => $this->description,
            // 'students' => $this->students,
            'students' => StudentTestResource::collection($this->students, $this->id),
            'subjects' => $this->subjects,
            'grade_groups' => $this->grade_groups
        ];
    }
}
