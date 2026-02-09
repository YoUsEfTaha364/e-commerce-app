<?php

namespace App\Http\Requests\Api\Admin;

use App\Services\api_response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AssignRoleRequest extends FormRequest
{
     public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response: api_response::Response(422, "validation error", $validator->errors())
        );
    }

    public function rules(): array
    {
        
        return [
            "role"=>["required","string",Rule::exists("roles","name")->where(fn($q) => $q->where("guard_name","web"))]
        ];
    }
}
