<?php

namespace App\Http\Requests;

use App\Services\Dto\QuestionDto;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'question_type' => ['required', 'string'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string']
        ];
    }

    public function toQuestionDto(): QuestionDto
    {
        return new QuestionDto(
            $this->user()->id,
            $this->get('question_type'),
            $this->get('title'),
            $this->get('content')
        );
    }
}
