<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use \Illuminate\Validation;

class StoreUserRequest extends FormRequest
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
            'first_name'=>['required','string','max:255'],
            'last_name'=>['required','string','max:255'],
            'email'=>['required','email','max:255','unique:users'],
            'password'=>['required','confirmed'],
            'is_doctor'=>['boolean'],
            'image'=>['nullable'],
            'phone'=>['required','string','max:20']
        ];
    }
}
