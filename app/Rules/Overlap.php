<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Gym;
use App\Session;
use App\Coach;
use Carbon\Carbon;

class Overlap implements Rule
{
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
        
        $sessions = Session::all();
        $date_to_compare = $this->data["day"];

        $from = strtotime(Carbon::create($date_to_compare . $value));
        $to = strtotime(Carbon::create($date_to_compare . $this->data["finish_at"]));
        
        foreach($sessions as $session){
            $from_compare = strtotime(Carbon::create($session->day . $session->start_at));
            $to_compare = strtotime(Carbon::create($session->day . $session->finish_at));
            
            if(($from > $from_compare && $from < $to_compare) ||($from_compare > $from && $from_compare < $to)){
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
        return "The chosen time overlapped with another session, \n Please choose carefully !";
    }
}
