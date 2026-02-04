<?php

namespace App\Http\Requests\Api;

use App\Services\api_response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAddressRequest extends FormRequest
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
            response: api_response::Response(
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
            "full_name" => [ "string", "max:255"],
            "phone" => [ "string", "digits:11"],
            "address" => [ "string", "max:255"],
            "state" => [ "string", "max:255"],
            "city" => [ "string", "max:255"],
            "is_default" => ["sometimes"],
        ];
    }

    
}
