<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstagramCallbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'nullable|string',
            'state' => 'nullable|string',
            'error' => 'nullable|string',
            'error_reason' => 'nullable|string',
            'error_description' => 'nullable|string',
        ];
    }
}
