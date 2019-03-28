<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use DB;

class StripeController extends Controller
{
    public function stripePackage(){
        $gyms = DB::table('gyms')->get();
        $members = DB::table('members')->get();
        return view('payments/stripe_package', [
            "gyms"=>$gyms,
            "members"=>$members,
        ]);
    }

    public function stripeSession(){
        $gyms = DB::table('gyms')->get();
        $members = DB::table('members')->get();
        return view('payments/stripe_session', [
            "gyms"=>$gyms,
            "members"=>$members,
        ]);
    }

    
    function fetchPackages(Request $request){

        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('packages')
        ->where($select, $value)
        ->get();
        
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        
        foreach ($data as $row) {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        echo $output;
    }

    function fetchSessions(Request $request){
        $select = 'gym_id';
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        info("1 ---->".$select);
        $data = DB::table('sessions')
            ->where('gym_id', $value)
            ->get();
        info("2 ---->".$data);
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
            
        foreach ($data as $row) {
            info(["3 ---->",$row]);
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        echo $output;
    }



    public function stripePost(Request $request){
        dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create(array(
            'email' => $request->stripeEmail,
            'source'  => $request->stripeToken
        ));
        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => 1999,
            'currency' => 'usd'
        ));
    }
}
