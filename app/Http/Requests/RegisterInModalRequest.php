<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterInModalRequest extends FormRequest
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
            'first_name' => 'bail|required|min:3|alpha',
            'last_name' => 'bail|required|min:3|alpha',
            'email' => 'email',
            'password' => 'bail|min:8',
            'password_repeat' => 'required_with:password|same:password|min:8',
            'phone' => 'bail|required|min:8|max:11'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Name is required field',
            'first_name.min' => 'Minimum of 3 characters for name field',
            'first_name.alpha' => 'Only alphabetic characters for first name and last name',
            'last_name.required' => 'Last name is required field',
            'last_name.min' => 'Minimum of 3 characters for last name',
            'last_name.alpha' => 'Only alphabetic characters in last name',
            'password.min' => 'Password\'s Minimum 8 characters',
            'password_repeat.same' => 'Passwords doesnt match',
            'phone.min' => 'Min 8 digits',
            'phone.numeric' => 'Phone must be numeric'
        ];
    }
}
