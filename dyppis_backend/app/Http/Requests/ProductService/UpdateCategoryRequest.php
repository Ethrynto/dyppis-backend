<?php

namespace App\Http\Requests\ProductService;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'title' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'max:8192', 'file', 'mimes:jpg,jpeg,png,webp,avif,svg'],
            'is_public' => ['nullable', 'boolean'],
        ];
    }
}
