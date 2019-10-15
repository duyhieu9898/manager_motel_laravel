<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvenienceRequest extends FormRequest
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
            'name' => 'required|min:4|max:36|unique:conveniences,name',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Convenience name is a required field',
            'min' => 'The convenience name must be at least :min characters',
            'max' => 'The convenience name must be at most :max characters.',
            'unique' => 'The selected convenience already exist',
        ];
    }
}
