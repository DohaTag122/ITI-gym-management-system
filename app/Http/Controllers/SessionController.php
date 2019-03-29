<?php

namespace App\Http\Controllers;

use App\Http\Requests\session\StoreSessionRequest;
use App\Http\Requests\session\UpdateSessionRequest;
use Illuminate\Http\Request;
use App\Gym;
use App\Session;
use App\Coach;


class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sessions/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gyms = Gym::all();
        $coaches = Coach::all();
        return view('sessions.create', [
            'gyms'=>$gyms,
            'coaches'=>$coaches,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionRequest $request)
    {   
        $session = Session::create(request()->all());
        
        foreach ($request->input("coach") as $coach_input) {
            $coach = Coach::find($coach_input);
            $session->coaches()->attach($coach);
        }
        
        return redirect()->route('sessions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        $gyms = Gym::all();
        $coaches = Coach::all();
        return view('sessions.show', compact('session', 'gyms', 'coaches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {

        $gyms = Gym::all();
        $coaches = Coach::all();
        return view('sessions.edit', compact('session', 'gyms', 'coaches'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionRequest $request, Session $session)
    {
        $session->update($request->all());
        return redirect()->route('sessions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::find($id)->delete();
        return response()->json(array('user'=>$id));
    }
    /**
     * Get the packages table as a json for jquery to render in DataTables .
     *
     * @return packagesTable(JSON)
     */

    public function get_table(){
        return datatables()->of(Session::with('gym'))->toJson();
    }

    function fetchCoaches(Request $request)
    {
        $value = $request->gym_id;
        $sessions = \Illuminate\Support\Facades\DB::table('coaches')
            ->where('gym_id', $value)
            ->get();
        $data['data'] = $sessions;
        return response()->json($data);
    }

}
