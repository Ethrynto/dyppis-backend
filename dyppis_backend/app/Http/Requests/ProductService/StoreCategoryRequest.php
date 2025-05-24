<?php

namespace App\Http\Requests\ProductService;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
            'title' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'max:8192', 'file', 'mimes:jpg,jpeg,png,webp,avif,svg'],
            'is_public' => ['nullable', 'boolean'],
        ];
    }
}
