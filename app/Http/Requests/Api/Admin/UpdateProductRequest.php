<?php

namespace App\Http\Requests\Api\Admin;

use App\Services\api_response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProductRequest extends FormRequest
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
            api_response::Response(422,"validation error",$validator->errors())
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
        'name'        => [ 'string', 'max:255'],
        'description' => [ 'string', 'max:255'],

        'category_id' => [ 'exists:categories,id'],

        'price'       => [ 'numeric', 'min:0'],
        'sale_price'  => ['numeric', 'min:0', 'lte:price'],

        'quantity'    => [ 'integer', 'min:0'],

        'status'      => [ 'in:active,inactive'],
        
        'product_image' => [
           
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048', // 2MB
        ],
    ];
}
}
