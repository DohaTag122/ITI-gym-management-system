<?php

namespace App\Http\Requests\session;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Overlap;
use Illuminate\Support\Facades\Input;

class StoreSessionRequest extends FormRequest
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
        $now = date("Y-m-d", time() - 60 * 60 * 24);
        return [
            'name'=>"bail|required|Alpha|max:16",
            'day'=>'bail|required|date|after:'.$now,
            'start_at'=>['bail','required', new Overlap(Input::get())],
            'finish_at'=>'bail|required',
            'price'=>'bail|required|numeric|min:1',
            'gym_id'=>"required|exists:gyms,id",
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
