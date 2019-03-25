<?php

namespace App\Http\Requests\User;

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
            "national_id"=>"unique:users",
            "email"=>"unique:users",
            "password"=>"min:6"
        ];


    }

    public function messages()
    {
        return [
            'national_id.unique' => 'National_ID can not be duplicate',
            'email.unique' => 'National_ID can not be duplicate',
            'password.unique' => 'The min char is 6',

            
        ];
    }
}
