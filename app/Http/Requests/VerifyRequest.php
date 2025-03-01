<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "code" => "required|string",
            "id" => "required|integer"
        ];
    }
}
