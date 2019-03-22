<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Requests\package\StorePackageRequest;
use App\Http\Requests\package\UpdatePackageRequest;
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
        return view('packages.create', [
            'gyms'=> $gyms,
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
        Package::create(request()->all());        
        return redirect()->route('packages.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // dd($id);
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
