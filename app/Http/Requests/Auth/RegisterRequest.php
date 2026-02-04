<?php

namespace App\Http\Requests\Auth;

use App\Services\api_response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(
        api_response::Response(
            422,
            "Validation error",
            $validator->errors()
        )
    );
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "firstname"=>"required|string|max:255",
            "lastname"=>"required|string|max:255",
            "email"=>"required|email|unique:users,email",
            "password"=>"required",
        ];
    }
}
