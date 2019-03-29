<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        return view('Attendances/index');
    }

    public function AttendancesTable()
    {
        $user = Auth::user();




        if($user->hasRole('admin'))
        {
            return datatables()->of(Attendance::with('session')->with('memeber'))->toJson();

        }

        else if($user->hasRole('cityManager'))
        {
            return datatables()->of(
                DB::table('attendances')
                    ->join('sessions','attendances.session_id','=','sessions.id')
                    ->join('members','attendances.member_id','=','members.id')
                    ->join('gyms','sessions.gym_id','=','gyms.id')
                    ->join('cities','gyms.city_id','=','cities.id')
                    ->where('city_manager_id',$user->id)


            )->toJson();
        }
        else
        {
            return datatables()->of(
                DB::table('attendances')
                    ->join('sessions','attendances.session_id','=','sessions.id')
                    ->join('members','attendances.member_id','=','members.id')
                    ->join('gyms','sessions.gym_id','=','gyms.id')
                    ->where('gyms.id',$user->gym_id)->select('members.name AS member_name',
                        'members.email AS member_email',
                        'sessions.name AS session_name',
                        'sessions.name AS session_name',
                        'attendance_time',
                        'attendance_date'
                    )->get()

            )->toJson();
        }


//        return datatables()->query(\Illuminate\Support\Facades\DB::table('attendances'))->toJson();
    }

}
