<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'value' => $this->id,
            'parent_category_id' => $this->parent_category_id,
            'label' => $this->name,
            'description' => $this->description,
            'attributes' => AttributeResource::collection($this->attribute)
            // 'price' => $this->price,
            // 'quentity' => $this->quentity
        ];
    }
}
