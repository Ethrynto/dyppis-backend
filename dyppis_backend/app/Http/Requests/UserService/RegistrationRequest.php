<?php

namespace App\Http\Requests\UserService;

// use App\Utils\ErrorMessages;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'nickname'          => ['required', 'string', 'max:100', 'unique:users,nickname'],
            'email'             => ['required', 'email', 'max:100', 'unique:users,email'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'device_name'       => ['nullable', 'string'],
            'ip_address'        => ['required', 'ip'],
            'seo_source'        => ['nullable', 'string'],
        ];
    }

//    public function messages(): array
//    {
//        return [
//            /* nickname field */
//            'nickname.required' => ErrorMessages::generate('field.required', ['field' => 'Nickname']),
//            'nickname.email' => ErrorMessages::generate('field.string', ['field' => 'Nickname']),
//            'nickname.unique' => ErrorMessages::generate('field.unique', ['field' => 'Nickname']),
//            'nickname.max' => ErrorMessages::generate('field.max', ['field' => 'Nickname', 'count' => '100']),
//
//            /* email field */
//            'email.required' => ErrorMessages::generate('field.required', ['field' => 'E-mail']),
//            'email.email' => ErrorMessages::generate('field.email', ['field' => 'E-mail']),
//            'email.unique' => ErrorMessages::generate('field.unique', ['field' => 'E-mail']),
//            'email.max' => ErrorMessages::generate('field.max', ['field' => 'E-mail', 'count' => '100']),
//
//            /* password field */
//            'password.required' => ErrorMessages::generate('field.required', ['field' => 'Password']),
//            'password.string' => ErrorMessages::generate('field.string', ['field' => 'Password']),
//            'password.min' => ErrorMessages::generate('field.min', ['field' => 'Password', 'count' => '8']),
//            'password.confirmed' => ErrorMessages::generate('password.confirmed'),
//        ];
//    }
}
