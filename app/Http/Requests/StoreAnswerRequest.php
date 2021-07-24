<?php

namespace App\Http\Requests;

use App\Services\Dto\AnswerDto;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'question_id' => ['required', 'int'],
            'content' => ['required', 'string']
        ];
    }

    public function toAnswerDto(): AnswerDto
    {
        return new AnswerDto(
            $this->get('question_id'),
            $this->user()->id,
            false,
            $this->get('content')
        );
    }
}
