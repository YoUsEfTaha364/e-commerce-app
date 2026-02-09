<?php

namespace App\Http\Requests\Api\Admin;

use App\Services\api_response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
class UpdateRolePermisssionsRequest extends FormRequest
{

  public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            api_response::Response(422, "validation error", $validator->errors())
        );
    }

  
    public function rules(): array
    {
        return [
            "name" => [ "string", Rule::unique('roles')
                ->where(fn($q) => $q->where('guard_name', 'web')),],

            'permissions' => [ 'array', 'min:1'],
            
            'permissions.*' => [
                'string',
                Rule::exists('permissions', 'name')
                    ->where(fn($q) => $q->where('guard_name', 'web')),
            ],
        ];
    }
}
