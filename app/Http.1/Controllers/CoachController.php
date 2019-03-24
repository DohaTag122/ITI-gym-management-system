<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coach;
use App\Gym;

class CoachController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view ('coaches.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coaches = Coach::all();
        return view('coaches.create',[
            'coaches' => $coaches,
            'gyms' => $gyms,
        ]);
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
        Coach::create($request->all());
        return redirect()->route('coaches.index');
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
       
        return view('coaches.show', [
            'coach' => Coach::find($id),
            'gym' => Gym::find(Coach::find($id)->gym_id)

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coach $coach)
    {
        //
        $coaches = Coach::all();
        return view('cities.edit', [
            'coach' => $coach,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coach $coach)
    {
        //
        $coach->update($request->all());
        return redirect()->route('coaches.index');
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
        $coach = Coach::find($id);
        $coach->delete();
        return response()->json(array('coach'=>$id));
    }

    public function coaches_table()
    {
        return datatables()->of(Coach::query())->toJson();
    }
}