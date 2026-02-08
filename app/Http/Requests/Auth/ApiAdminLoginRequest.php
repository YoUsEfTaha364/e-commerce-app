<?php

namespace App\Http\Requests\Auth;

use App\Services\api_response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ApiAdminLoginRequest extends FormRequest
{
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

            'email' => ['required', 'string', 'email', "exists:users,email"],
            'password' => ['required', 'string'],

        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        if(!$this->checkAdmin()){
            throw ValidationException::withMessages([
                'admin' => ['you are not permitted'],
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
            return;
        }

        throw ValidationException::withMessages([
            'email' => ['Too many login attempts. Try again later.'],
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::lower($this->input('email')) . '|' . $this->ip();
    }

    protected function checkAdmin(){
        $is_admin=$this->user()->is_admin;

        return $is_admin;

    }
}
