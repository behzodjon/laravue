<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'category_id' => $this->category_id,
            'category' => new CategoryResource($this->category),
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'lesson_count' => $this->lesson_count,
            'status' => $this->status,
        ];

    }
}
