<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'age' => $this->age,
            'cat_pattern_type' => $this->catPatternType->type,
            'cat_type' => $this->catType->type,
            'type' => $this->type,
        ];
    }
}
