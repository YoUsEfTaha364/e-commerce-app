<?php

namespace App\Http\Requests\Api\Admin;

use App\Services\api_response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class RolePermisssionsRequest extends FormRequest
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
            api_response::Response(422, "validation error", $validator->errors())
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
            "name" => ["required", "string", Rule::unique('roles')
                ->where(fn($q) => $q->where('guard_name', 'web')),],

            'permissions' => ['required', 'array', 'min:1'],
            
            'permissions.*' => [
                'string',
                Rule::exists('permissions', 'name')
                    ->where(fn($q) => $q->where('guard_name', 'web')),
            ],
        ];
    }
}
