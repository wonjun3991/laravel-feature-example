<?php

namespace App\Http\Requests;

use App\Rules\UserTypeRule;
use App\Services\Dto\UserDto;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}
