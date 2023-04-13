<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required',
            'job' => 'required',
            'phone' => 'required',
            'shopid' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Hodim ismini kiriting',
            'job.required' => 'Kasbini kiriting',
            'phone.required' => 'Telefon nomerini kiriting',
            'shopid.required' => 'Qaysi omborda ishlashini tanlang',
        ];
    }
}
