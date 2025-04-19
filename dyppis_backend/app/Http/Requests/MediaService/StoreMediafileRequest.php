<?php

namespace App\Http\Requests\MediaService;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediafileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:8192', // 8MB
            ],
            'category_id' => [
                'required',
                'exists:mediafile_categories,id',
            ],
        ];
    }
}
