<?php

namespace App\Http\Requests\UserService;

//use App\Utils\ErrorMessages;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorizationRequest extends FormRequest
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
            'email'         => ['required', 'email'],
            'password'      => ['required'],
            'device_name'   => ['nullable', 'string'],
        ];
    }

//    public function messages() : array
//    {
//        return [
//            /* email field */
//            'email.required' => ErrorMessages::generate('field.required', ['field' => 'E-mail']),
//            'email.email' => ErrorMessages::generate('field.email', ['field' => 'E-mail']),
//
//            /* password field */
//            'password.required' => ErrorMessages::generate('field.required', ['field' => 'Password']),
//        ];
//    }
}
