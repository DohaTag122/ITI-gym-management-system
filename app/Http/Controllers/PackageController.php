<?php

namespace App\Http\Controllers;

use App\Http\Requests\package\UpdatePackageRequest;
use App\Http\Requests\package\StorePackageRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Session;
use App\Package;
use App\User;
use App\Gym;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return packagesView
     */
    public function index()
    {
        return view('packages/packages');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gyms = Gym::all();
        $sessions = Session::all();
        return view('packages.create', [
            'gyms'=> $gyms,
            'sessions'=> $sessions
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {   
        if ($request->input("session_amount")) {
            if (array_sum(Input::get('session_amount')) > Input::get('number_of_sessions')) {
                return redirect()->back()->withErrors('Session amounts were more than your number of sessions')->withInput();
            }
            for ($i=0; $i < sizeof($request->input("session_amount")); $i++) {
                $session = Session::find($request->get('session_id')[$i]);
                $package->sessions()->attach($session, ["session_amount"=>Input::get('session_amount')[0]]);   
            }
        }
        $package = Package::create(request()->all());
        
        

        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('packages.show', [
            "package"=>$package
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $gyms = Gym::all();
        return view('packages.edit', compact('package', 'gyms'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());
        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Package::find($id)->delete();
        return response()->json(array('user'=>$id));

    }
    /**
     * Get the packages table as a json for jquery to render in DataTables .
     *
     * @return packagesTable(JSON)
     */

    public function get_table(){
        return datatables()->of(Package::with('gyms'))->toJson();
    }
}
