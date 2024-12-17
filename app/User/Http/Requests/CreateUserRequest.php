<?php

namespace App\Task\Http\Requests;

use App\Core\Http\Requests\BaseFormRequest;

class CreateUserRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'username' => 'required|string|max:255|unique:users',
            'role' => 'required|string'
        ];
    }
}
