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
            'email' => 'required|string|max:255|unique:users',
            
            'phone' => 'required|regex:/^(!?){0}([+]){1}([998]){3}([7-9]){1}([0-9]){1}([0-9]){3}([0-9]){2}([0-9]){2}$/',

            'password' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Name ustuni toldirilsin',
            'name.max' => 'Name ustunida maksimal 255 ta belgi bolishi kerak',
            'email.required' => 'Email ustuni toldirilsin',
            'email.max' => 'Email ustunida maksimal 255 ta belgi bolishi kerak',
            'email.unique' => 'Email unikalni bolishi kerak',
            'phone.required' => 'telefon ustuni toldirilsin',
            'phone.regex' => 'telefon raqam +998 bilan boshlanib 12 ta raqam bolishi kerak',
        ];
    }
}
