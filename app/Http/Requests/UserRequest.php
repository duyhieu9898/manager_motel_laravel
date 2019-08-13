<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:6|max:18',
            'email' => 'required|email',
            'role' => 'exists:roles,name',
            'phone' => 'required|string|min:10|max:10',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is a required field',
            'min' => 'The :attribute must be at least :min characters',
            'max' => 'The :attribute must be at most :max characters.',
            'email' => 'email Invalid ',
            'exists' => ":attribute not exists",
        ];
    }
}
