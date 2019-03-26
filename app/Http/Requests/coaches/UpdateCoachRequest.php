<?php

namespace App\Http\Requests\coaches;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoachRequest extends FormRequest
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
            'gym_id' => 'required|exists:gyms,id' ,
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The coach name is required',
            'name.alpha'    => 'The coach name must be only letters',
            'name.max'      => 'The coach name may have 15 characters at most',
            'gym_id.exists' => 'This gym id is not stored in the database',
        ];
    }
}
/*  */