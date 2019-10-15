<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomCreateRequest extends FormRequest
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
            'category_id' => 'required|numeric',
            'address_id' => 'required|numeric',

            'title' => 'required|string|min:10|max:999',
            'room_area' => 'required|numeric|min:1|max:999',
            'maximum_peoples_number' => 'required|numeric|min:1|max:999',
            'price' => 'required|numeric|min:1|max:99999999',
            'description' => 'required|string|between:10,999',
            'police_and_terms' => 'required|string|between:10,999',
            'list_conveniences_id' => 'array',
            'list_images_id' => 'required|array'
            ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The room title field is required.',
            'title.min' => "The room title must be at least 5 words.",
            'title.max' => "The room title may not be greater than 999 characters.",
            'category_id.numeric' => 'The room category field is required.',
            'address_id.required' => 'The room address field is required.',
            'list_conveniences_id' => 'The room conveniences field is required.',
            'room_area.min' => 'The room area field is required.',
            'price.min' => 'The room price field is required.',
            'list_images_id.required' => 'The room image has at least 1 photo.',
        ];
    }
}
