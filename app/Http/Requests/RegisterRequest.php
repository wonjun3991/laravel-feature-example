<?php

namespace App\Http\Requests;

use App\Rules\UserTypeRule;
use App\Services\Dto\UserDto;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'type' => ['required', 'string', new UserTypeRule],
            'catType' => ['required', 'string'],
            'catPatternType' => ['required', 'string'],
            'age' => ['required', 'int', 'min:1', 'max:15']
        ];
    }

    public function toUserDto(): UserDto
    {
        return new UserDto(
            $this->get('email'),
            $this->get('password'),
            $this->get('type'),
            $this->get('catType'),
            $this->get('catPatternType'),
            $this->get('age')
        );
    }
}
