<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6",
            "name" => "required|string|min:3",
        ];
    }
}
