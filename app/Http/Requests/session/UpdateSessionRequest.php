<?php

namespace App\Http\Requests\session;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Overlap;
use Illuminate\Support\Facades\Input;

class UpdateSessionRequest extends FormRequest
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
        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
        return [
            'name'=>"bail|unique:sessions,name,".$this->route('session')->id,
            'day'=>'bail|required|date|after:'.$yesterday,
            'start_at'=>['bail','required', new Overlap(Input::get())],
            'finish_at'=>'bail|required|after:start_at',
        ];
    }
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'day.after' => 'The chosen date has passed, pick a new date please !',
        ];
    }
}
