<?php

namespace App\Http\Requests\package;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ExceedLimit;
use Illuminate\Support\Facades\Input;


class StorePackageRequest extends FormRequest
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
            'name'=>"bail|required|Alpha|max:16",
            'package_price'=>'bail|required|numeric|min:1',
            'number_of_sessions'=>'bail|required|numeric|min:1',
            'gym_id'=>"required|exists:gyms,id",
            'session_amount'=>['required', new ExceedLimit(Input::get())]
        ];
    }
}
