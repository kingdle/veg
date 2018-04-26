<?php

namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class WeappAuthorizationRequest extends FormRequest
{
    public function authorize()
    {
        // Using policy for Authorization
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|string',
            'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:users',
            'title' => 'required|min:2|unique:shops',
        ];
    }
    public function messages()
    {
        return [
            'phone.unique' => '手机已被占用，请重新填写',
            'title.unique' => '店名已被占用，请重新填写',
        ];
    }
}
