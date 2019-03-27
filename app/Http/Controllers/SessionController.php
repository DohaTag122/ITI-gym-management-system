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
        // dd(Session::with('gym')->get()[0]->gym);
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
        
        for ($i=0; $i < sizeof($request->input("coach")); $i++) {
            $coach = coach::find($request->get('coach')[$i]);
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
        // dd($session);
        return view('sessions.show', [
            "session"=>$session
        ]);
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
        // dd($gym_session);
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
}
