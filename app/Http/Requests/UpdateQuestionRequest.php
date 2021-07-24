<?php

namespace App\Http\Requests;

use App\Services\Dto\QuestionDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'question_type' => ['nullable', 'string'],
            'title' => ['nullable', 'string'],
            'content' => ['nullable', 'string']
        ];
    }

    public function toQuestionDto(): QuestionDto
    {
        return new QuestionDto(
            $this->user()->id,
            $this->has('question_type') ? $this->get('question_type') : null,
            $this->has('title') ? $this->get('title') : null,
            $this->has('content') ? $this->get('content') : null,
        );
    }
}
