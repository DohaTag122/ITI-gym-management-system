<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExceedLimit implements Rule
{
    protected $data;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value) {
            if (array_sum($this->data['session_amount']) > $this->data['number_of_sessions']) {
            return false;
            }else{
                return true;
            }

        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You\'ve exceeded the number of sessions in the package.';
    }
}
