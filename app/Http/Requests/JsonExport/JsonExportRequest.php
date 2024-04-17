<?php

namespace App\Http\Requests\JsonExport;

use Illuminate\Foundation\Http\FormRequest;

class JsonExportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:json',
        ];
    }
}
