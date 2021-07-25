<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'question_id' => $this->question_id,
            'content' => $this->content,
            'selected' => $this->selected,
            'created_at' => $this->created_at,
            'user' => [
                'type' => $this->user->type,
                'cat_type' => $this->user->catType->type,
                'cat_pattern_type' => $this->user->catPatternType->type
            ]
        ];
    }
}
