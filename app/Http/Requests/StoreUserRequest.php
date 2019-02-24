<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'Name max length is :max',
            'email.required'  => 'An email is required',
            'email.max' => 'Email max length is :max',
            'email.email' => 'Email format is not valid',
            'email.unique' => 'Email is already taken',
            'password.required'  => 'A password is required',
            'password.min'  => 'Password min length is :min',
            'password.confirmed'  => "Passwords doesn't match",
        ];
    }
}
