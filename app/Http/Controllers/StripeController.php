<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use DB;
use App\Session;
use App\Purchase;

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
        // dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create(array(
            'email' => $request->stripeEmail,
            'source'  => $request->stripeToken
        ));


        $package_id = $request->input('package');
        $member_id = $request->input('member_id');

        $package = Package::find($package_id);

        $sessions = $package->sessions;

        $price = 0;
        foreach ($sessions as $session)
        {
            $purchase['member_id'] = $member_id;
            $purchase['session_id'] = $session->id;
            $purchase['init_price'] = $session->price;

            $price += $session->price;
            Purchase::create($purchase);
        }

        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $price,
            'currency' => 'usd'
        ));
        return redirect()->back()->with('message', 'You purchased the package successfully!');

    }

    public function stripePost_session(Request $request){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create(array(
            'email' => $request->stripeEmail,
            'source'  => $request->stripeToken
        ));

        $session_id = $request->input('session_id');
        $member_id = $request->input('member_id');
        
        $session = Session::find($session_id);

        $purchase['member_id'] = $member_id;
        $purchase['session_id'] = $session->id;
        $purchase['init_price'] = $session->price;
        // dd($purchase);
        Purchase::create($purchase);
        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $session->price,
            'currency' => 'usd'
        ));

        return redirect()->back()->with('message', 'You purchased the session successfully!');
    }    
}
