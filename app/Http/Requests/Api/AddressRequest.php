<?php

namespace App\Http\Requests\Api;

use App\Services\api_response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
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
            "full_name" => ["required", "string", "max:255"],
            "phone" => ["required", "string", "digits:11"],
            "address" => ["required", "string", "max:255"],
            "state" => ["required", "string", "max:255"],
            "city" => ["required", "string", "max:255"],
            "is_default" => ["sometimes"],
        ];
    }
}
