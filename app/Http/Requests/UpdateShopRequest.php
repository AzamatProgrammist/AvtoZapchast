<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
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
            "name_uz" => 'required',
            "user_id" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_uz.required' => 'Magazin nomi kiritilishi shart',
            'user_id.required' => 'Admin tanlash shart',
        ];
    }
}
