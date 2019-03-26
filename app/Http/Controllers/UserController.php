<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Users.index', [
            'users' => User::all()
        ]);

      
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        // dd(User::all());
        $users = User::all();
        return view('Users.create',[
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {  // dd( User::create(request()->all()));
        // dd(request()->all());
       $user= User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "image" => $request->image,
            "ban" => $request->ban,
            "gymid" => $request->gymid,
            "role" => $request->role,
       ]);
       
        if(request()->all()['role']=="admin")
        { 
          
          $user->assignRole('admin');
        }elseif(request()->all()['role']=="cityManager")
        {
            auth()->user()->assignRole('cityManger');
        }elseif(request()->all()['role']=="gymManger")
        {
            auth()->user()->assignRole('gymManger');
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
     
    { 
          $user = User::find($id);
        return view('Users.show', [
            'user' => $user,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user = User::find($id);
        return view('Users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user,Request $request)
    { //dd($request);
       User::where('id',$user->id)->update(['name'=>request()->name]); 
       User::where('id',$user->id)->update(['email'=>request()->email]); 
       User::where('id',$user->id)->update(['password'=>Hash::make(request()->password)]);
       User::where('id',$user->id)->update(['national_id'=>request()->national_id]);
       return redirect()->route('home');
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    { 
        $user_data = \App\User::find($user);
        \App\User::find($user)->delete();
        return response()->json(array('user'=>$user_data));
    }
   
   /* public function getdata(){
        //return datatables()->of(User::role('cityManager')->get())->toJson();

        return view('Users.index', [
            'users' => User::role('cityManager')
        ]);
    }*/

    public function ban($id)

    {
        $user = User::find($id)->ban();
        return redirect()->route('home');
    }
    public function unban($id)

    {
        $user = User::find($id)->unban();
        return redirect()->route('home');
    }
}
