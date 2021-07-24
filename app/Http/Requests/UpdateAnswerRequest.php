<?php

namespace App\Http\Requests;

use App\Services\Dto\AnswerDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'question_id' => ['nullable', 'int'],
            'content' => ['nullable', 'string'],
            'selected' =>['nullable','boolean']
        ];
    }

    public function toAnswerDto(): AnswerDto
    {
        return new AnswerDto(
            $this->get('question_id'),
            $this->user()->id,
            $this->get('selected'),
            $this->get('content')
        );
    }
}
