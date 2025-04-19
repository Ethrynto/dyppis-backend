<?php

namespace App\Http\Requests\ProductService;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlatformRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:255', 'unique:platforms,slug'],
            'title' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:8192', 'file', 'mimes:jpg,jpeg,png,webp,avif'],
            'category' => ['required', 'exists:platform_categories,id'],
            'parent' => ['nullable', 'exists:platforms,id'],
            'sales' => ['nullable', 'integer'],
            'views' => ['nullable', 'integer'],
        ];
    }
}
