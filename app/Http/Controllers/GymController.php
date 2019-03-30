<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Gym;
use App\City;
use App\User;
use DB;

use App\Http\Requests\gyms\StoreGymRequest;
use App\Http\Requests\gyms\UpdateGymRequest;
use Illuminate\Support\Facades\Storage;

class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        
        return view('gyms.create',[
            'gyms' => $gyms,
            'cities' => $cities,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGymRequest $request)
    {
        $logged_user = Auth::user();
        $path = Storage::disk('public')->put('gym_img', $request->image);

       Gym::create([
        "name"   => $request->name,
        "city_id"=> $request->city_id,
        "image"  => $path,
        "city_manager_id"=> $logged_user->id,
    ]);
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
        $cities = City::all();

        $gyms = Gym::all();
        return view('gyms.edit', [
            'gym' => $gym,
            'cities' => $cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGymRequest $request, Gym $gym)
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
        $logged_user = Auth::user();

        if($logged_user->hasRole('admin'))
        {
            // $cityManagers = User::with('roles')->where('role', 'cityManager')->get();
          
            // // $x = Gym::with(['sessions','city'])->get();
            // // dd($x, $x['sessions'] );
            return datatables()->of(Gym::query())->toJson();
        }
      
        if($logged_user->hasRole('cityManager'))
        {
                $gyms = Gym::where("city_manager_id",$logged_user->id)->get();
                return datatables($gyms)->toJson();
            
        }
        if($logged_user->hasRole('gymManager'))
        {
                if(User::where("id",$logged_user->id)->get('gym_id')){
                    $gyms = Gym::where("id",$gym_id)->get('gym_id');
                    return datatables($gyms)->toJson();

                }else{
                    return response()->json(array('user'=>$logged_user->id)); 
                }
            
        }
    }


    public function get_managers($id) {
        
        $managers_id   = DB::table("user_city")->where("city_id",$id)->pluck("user_city.user_id");
        $users = User::find($managers_id);
        $managers_Name = User::get(['users.id', 'users.name']);   
        return json_encode($managers_Name);
        
    }
}
