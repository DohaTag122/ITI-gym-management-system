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
        $package = Package::create(request()->all());
        
        foreach ($request->input("session_amount") as $key=>$single_amount) {    
            $session = Session::find($request->get('session_id')[$key]);
            $package->sessions()->attach($session, ["session_amount"=> $single_amount]);
        }
        
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
        
        $gyms = Gym::all();
        $sessions = Session::all();
        
        return view('packages.show', [
            "package"=>$package,
            "gyms"=>$gyms,
            "sessions"=>$sessions
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
