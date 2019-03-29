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
        $packages = DB::table('packages')->get();

        return view('payments/stripe_package', [
            "gyms"=>$gyms,
            "members"=>$members,
            "packages"=>$packages,
        ]);
    }

    public function stripeSession(Request $request){
        $gyms = DB::table('gyms')->get();
        $members = DB::table('members')->get();
        $sessions = DB::table('sessions')->get();
        
        return view('payments/stripe_session', [
            "gyms"=>$gyms,
            "members"=>$members,
            "sessions"=>$sessions,
        ]);
    }

    
    function fetchPackages(Request $request){

        $value = $request->gym_id;

        $packages = DB::table('packages')
        ->where('gym_id', $value)
        ->get();

        $data['data'] = $packages;
        return response()->json($data);


    }

    function fetchSessions(Request $request){

        $value = $request->gym_id;
        $sessions = \Illuminate\Support\Facades\DB::table('sessions')
            ->where('gym_id', $value)
            ->get();
        $data['data'] = $sessions;
        return response()->json($data);

    }



    public function stripePost_package(Request $request){
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

        dd($charge);
    }
}
