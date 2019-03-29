<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\City;
use App\Http\Requests\cities\StoreCityRequest;
use App\Http\Requests\cities\UpdateCityRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view ('cities.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('cities.create',[
            'cities' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        //
        City::create($request->all());
        return redirect()->route('cities.index');
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
        return view('cities.show', [
            'city' => City::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
        return view('cities.edit', [
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        //
        $city->update($request->all());
        return redirect()->route('cities.index');
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
        $city = City::find($id);
        $city->delete();
        return response()->json(array('city'=>$id));
    }

    public function cities_table()
    {
        $logged_user = Auth::user();

        if($logged_user->hasRole('admin'))
        {
            return datatables()->of(City::query())->toJson();
        }
        if($logged_user->hasRole('cityManager'))
        {
            $city_id =  DB::table("user_city")->where("user_id",$logged_user->id)->pluck("user_city.city_id");
            $cities  = City::where("id",$city_id);
            return datatables($cities)->toJson();
            
        }
               
    }
}
