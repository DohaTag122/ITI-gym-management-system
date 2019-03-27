<?php

namespace App\Http\Controllers\Api;

use App\Attendance;
use App\Http\Requests\EditMemberRequest;
use App\Http\Resources\AttendanceResource;
use App\Notifications\SignupActivate;
use App\Notifications\WelcomeNotify;
use App\Purchase;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAuthRequest;
use App\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
//use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class MemberController extends Controller
{
    public $loginAfterSignUp = false;

    public function register(RegisterAuthRequest $request)
    {
//        $data = $request->validated();
//        return $data;

        $user = new Member();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = bcrypt($request->password);

        $path = Storage::disk('public')->put('avatars', $request->image);
        $user->profile_image = $path;
        $user->activation_token = str_random(60);

        $user->save();

        $image_name = 'member_'.$user->id.'.jpg';



        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
        $user->notify(new SignupActivate($user));



        return response()->json([
            'success' => true,
            'data' => 'verify your account'
        ], 200);
    }

    public function login(Request $request)
    {

        $input = $request->only('email', 'password');
        $input['active'] = 1;

//        $input['deleted_at'] = null;
        $jwt_token = null;
        Config::set( 'auth.defaults.guard', 'api' );
        Config::set('auth.providers.users.table', 'members');

        Config::set('auth.providers.users.model', Member::class);
        Config::set('jwt.user', Member::class);


//        dd($jwt_token = JWTAuth::attempt($input));
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }


        $current_date = Carbon::now()->setTimezone('Africa/Cairo')->toDateString();
        Auth::user()->last_log_in = $current_date;

        return response()->json([
            'success' => true,
            'data'=>Auth::user(),
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }



    public function signupActivate($token)
    {
        $user = Member::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        $user->notify(new WelcomeNotify($user));
        return $user;
    }


    public function update(EditMemberRequest $request)
    {

        $member_id = Auth::user()->id;

        $data = $request->only('name', 'password','gender','date_of_birth','profile_image');

        $updated_member = Member::find($member_id);

        if($updated_member)
        {
            $updated_member->update($data);
            $member_data = $updated_member;
        }
        else
            {
                $member_data = 'user not found';
            }

        return response()->json(['data' => $member_data]);

    }


    public function sessions_details()
    {
        $member_id = Auth::user()->id;

        $purchases = Member::find($member_id)->purchases->count();
        $attendances = Member::find($member_id)->attendances->count();
        $remaining = $purchases - $attendances;


        return response()->json(["total_sessions"=>$purchases,"remaining_sessions" => $remaining]);
    }



    public function sessions()
    {
        $member_id = Auth::user()->id;
        $attended_sessions = Attendance::where('member_id',$member_id)->pluck('session_id')->toArray();
        $sessions = Member::find($member_id)->sessions->whereNotIn('id', $attended_sessions);

        return response()->json(["sessions"=>$sessions]);
    }



    public function attend($id)
    {

        $member_id = Auth::user()->id;
        $session_exist = Member::find($member_id)->sessions->where('id', $id)->count();

        if($session_exist > 0)
        {
            $member_id = Auth::user()->id;
            $Current_day = Carbon::now()->setTimezone('Africa/Cairo');
            $current_date = Carbon::now()->toDateString();
            $current_time = Carbon::now()->toTimeString();

            $session = Session::findorFail($id);
            $Session_date = Carbon::parse($session->start_at);
//            $date = $Session_date->format('Y-m-d');
//            $time = $Session_date->format('H:i:s');
//            dd($Current_day." / ".$Session_date);
//            dd($Current_day->isSameDay($Session_date));
//            dd($Session_date->isCurrentDay());
//            dd($Session_date->isPast());
//            dd($Session_date->isFuture());
            if($Current_day->isSameDay($Session_date))
            {
                $attendance = new Attendance();
                $attendance->member_id = $member_id;
                $attendance->session_id = $id;
                $attendance->attend = 1;
                $attendance->attendance_date = $current_date;
                $attendance->attendance_time = $current_time;
                $attendance->save();
            }

            else
                {
                    $message = null ;
                    if($Session_date->isPast())
                    {
                        $message = "already finished";
                    }
                    else if($Session_date->isFuture())
                    {
                        $message = "does't come yet";
                    }

                    $attendance = "You cant attend this session ".$message;
                }
        }
        else
            {
                $attendance = "this session doesn't exist please buy training sessions first";
            }

      return response()->json(["attendance"=>$attendance]);
    }



    public function attendances_history()
    {

        $member_id = Auth::user()->id;
        $attendances = Attendance::where('member_id',$member_id)->with('session')
            ->get();

        return new AttendanceResource($attendances);
//        return response()->json(["attendances"=>$attendances]);
    }



}


