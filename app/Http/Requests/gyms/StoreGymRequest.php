<?php

namespace App\Http\Requests\gyms;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymRequest extends FormRequest
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
            'name' => 'bail|required|alpha|max:25',
            'city_id' => 'required|exists:cities,id' ,
            'image' => 'required|image'
        ];
    }
}
