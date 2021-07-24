<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'question_type' => $this->questionType,
            'title' => $this->title,
            'content' => $this->content,
            'created_at'=>$this->created_at,
            'answers' => AnswerResource::collection($this->answers),
            'user' => [
                'id' => $this->user->id,
                'type' => $this->user->type,
                'cat_type' => $this->user->catType,
                'cat_pattern_type' => $this->user->catPatternType,
            ]
        ];
    }
}
