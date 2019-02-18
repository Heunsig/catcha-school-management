<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'label' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quentity' => $this->quentity,
            'attributes' => AttributeResource::collection($this->attribute)
        ];
    }
}
