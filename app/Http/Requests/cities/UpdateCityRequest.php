<?php

namespace App\Http\Requests\cities;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
            'name' => 'bail|required|alpha|min:3|max:15|unique:cities,name,'.$this->post['id'], 
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The city name is required',
            'name.alpha'    => 'The city name must be only letters',
            'name.max'      => 'The city name may have 15 characters at most',
            'name.min'      => 'The city name may have 3 characters at least',
            'name.unique'   => 'The city name is aleardy stored',
        ];
    }
}
       