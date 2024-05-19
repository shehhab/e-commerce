<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisterRequest extends Request
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
        $rules = [
            'name'=>['required','string','min:3','max:25'],
            'email'=>['required','string','email','max:255','unique:' . User::class,
            function ($attribute, $value, $fail) {
                if (!Str::contains($value, '.')) {
                    $fail($attribute.' must be a valid email address from .com');
                }
                $parts = explode('@', $value);
                $localPart = $parts[0];
                // Check if local part consists only of digits
                if (ctype_digit($localPart)) {
                    $fail($attribute.' must be a valid email address with characters other than digits before the @ symbol');
                }
    }],


            'password' => ['required',Rules\Password::defaults(), new \App\Rules\StrongPassword],

            'password_confirme' => ['required', 'same:password'],


            'phone_number' => 'nullable|string|max:20',

        ];



        return $rules;
    }
    public function messages()
{
    return [
        'role.in' => 'The role must be one of the following: Worker, Customer.',
    ];

    }
}
