<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Coach;
use App\Gym;
use App\User;
use App\Http\Requests\coaches\StoreCoachRequest;
use App\Http\Requests\coaches\UpdateCoachRequest;

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
        $logged_user = Auth::user();
        if($logged_user->hasRole('admin'))
        {
            $gyms = Gym::all();
        }
      
        if($logged_user->hasRole('cityManager'))
        {
            $gyms = Gym::where("city_manager_id",$logged_user->id)->get();
        }
        if($logged_user->hasRole('gymManager'))
        {
            if(User::where("id",$logged_user->id)->get('gym_id')){
                $gym_id = User::where("id",$logged_user->id)->get('gym_id');
                $gyms = Gym::where("id",$gym_id)->get();
            }else{
                $gyms = "";
            }

            
        }
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
    public function store(StoreCoachRequest $request)
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
        
        $logged_user = Auth::user();
        if($logged_user->hasRole('admin'))
        {
            $gyms = Gym::all();
        }
        if($logged_user->hasRole('cityManager'))
        {
            $gyms = Gym::where("city_manager_id",$logged_user->id)->get();
        }
        if($logged_user->hasRole('gymManager'))
        {
            if(User::where("id",$logged_user->id)->get('gym_id')){

            $gym_id = User::where("id",$logged_user->id)->get('gym_id');
            $gyms = Gym::where("id",$gym_id)->get();
            }else{
            $gyms = "";   
            }
        }
        return view('coaches.edit', [
            'coach' => $coach,
            'gyms' =>  $gyms, 

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoachRequest $request, Coach $coach)
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
        $logged_user = Auth::user();

        if($logged_user->hasRole('admin'))
        {
            return datatables()->of(Coach::query())->toJson();
        }
      
        if($logged_user->hasRole('cityManager'))
        {
            if(Gym::where("city_manager_id",$logged_user->id)->get()){
                $ids_of_gyms_in_city = Gym::where("city_manager_id",$logged_user->id)->get('id');
                if(Coach::where("gym_id",$ids_of_gyms_in_city)->get()){
                    return datatables(Coach::where("gym_id",$ids_of_gyms_in_city)->get())->toJson();
                }else{
                    return response()->json(array('user'=>$logged_user->id));
                }
            }else{
                return response()->json(array('user'=>$logged_user->id));
            }
        }
        if($logged_user->hasRole('gymManager'))
        {       
                if(User::where("id",$logged_user->id)->get('gym_id')){
                    $gym_id = User::where("id",$logged_user->id)->get('gym_id');
                    $coachs = Coach::where("gym_id",$gym_id)->get();
                    return datatables($coachs)->toJson();
                }else{
                    return response()->json(array('user'=>$logged_user->id)); 
                }
        }
    }
}