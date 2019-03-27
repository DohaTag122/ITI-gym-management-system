<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gym;
use App\City;
use App\User;


use App\Http\Requests\gyms\StoreGymRequest;
use App\Http\Requests\gyms\UpdateGymRequest;

class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view ('gyms.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gyms   = Gym::all();
        $cities = City::all();
        //$managers_of_city = City::find(1)->City_manager;
        //$managers_of_cities = City::all()->City_manager;
        return view('gyms.create',[
            'gyms' => $gyms,
            'cities' => $cities,
            //'managers_of_cities' => $managers_of_cities,
        ]);
        // foreach ($city->City_manager as $cc){
        //     dd($city->City_manager);
        // }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $file = $request->file('image');
        // dd($request->all());
        // $destinationPath = 'public/img';
        // $file->move($destinationPath,$file->getClientOriginalName());
        Gym::create($request->all());
        return redirect()->route('gyms.index');
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
        return view('gyms.show', [
            'gym' => Gym::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gym $gym)
    {
        //
        $gyms = Gym::all();
        return view('gyms.edit', [
            'gym' => $gym,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gym $gym)
    {
        //
        $gym->update($request->all());
        return redirect()->route('gyms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $gym = Gym::find($id);
        $gym->delete();
        return response()->json(array('gym'=>$id));
    }

    public function gyms_table()
    {
        return datatables()->of(Gym::query())->toJson();
    }


    public function managers_of_city(Request $request, $id) {
        dd("aho");
        if ($request->ajax()) {
            return response()->json([
                'managers_of_city' => City::find($id)->City_manager,
            ]);
        }
    }
}
