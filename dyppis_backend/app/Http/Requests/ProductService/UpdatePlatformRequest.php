<?php

namespace App\Http\Requests\ProductService;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlatformRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['nullable', 'string', 'max:255', 'unique:platforms,slug'],
            'title' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:8192', 'file', 'mimes:jpg,jpeg,png,webp,avif'],
            'category' => ['nullable', 'exists:platform_categories,id'],
            'parent' => ['nullable', 'exists:platforms,id'],
            'sales' => ['nullable', 'integer'],
            'views' => ['nullable', 'integer'],
        ];
    }
}
