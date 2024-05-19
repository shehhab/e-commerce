<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Http\Requests\Request;

class ResetPasswordRequest extends Request
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>['required','string','email','exists:users,email'],
            'otp'=>['required','max:4'],
            'password' => ['required',Rules\Password::defaults(), new \App\Rules\StrongPassword

],        ];
    }
}
