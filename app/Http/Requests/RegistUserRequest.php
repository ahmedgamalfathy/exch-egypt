<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistUserRequest extends FormRequest
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
        return[
            "name"=>"required|string",
            "phone"=>"required|numeric|min:6|unique:users,phone",
            "email"=>"nullable|email|unique:users,email",
            "password"=>"required|min:8|confirmed"
           ];
    }
}
