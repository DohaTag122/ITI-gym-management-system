<?php

namespace App\Http\Requests\session;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>"bail|required|Alpha|max:16|unique:session,name,".$this->session->id,
            'day'=>'bail|required|date',
            'start_at'=>'bail|required',
            'finish_at'=>'bail|required',
            'price'=>'bail|required|numeric|min:1',
            'gym_id'=>"required|exists:gyms,id",
        ];
    }
}
