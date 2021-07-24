<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class QuestionCollection extends ResourceCollection
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
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'question_type' => $item->questionType->type,
                    'title' => $item->title,
                    'content' => Str::limit($item->content, 20),
                    'created_at' => $item->created_at,
                    'user' => [
                        'cat_type' => $item->user->catType->type,
                        'cat_pattern_type' => $item->user->catPatternType->type,
                        'type' => $item->user->type
                    ]
                ];
            }),
            'links' => [
                'self' => 'link-value'
            ]
        ];

    }
}
