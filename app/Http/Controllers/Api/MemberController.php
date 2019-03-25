<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EditMemberRequest;
use App\Notifications\SignupActivate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAuthRequest;
use App\Member;
use Illuminate\Support\Facades\Config;
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
        $user->activation_token = str_random(60);

        $user->save();

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



        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
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
        return $user;
    }


    public function update(EditMemberRequest $request,$member)
    {

        $data = $request->only('name', 'password','gender','date_of_birth','profile_image');

        $updated_member = Member::find($member);

        if($updated_member)
        {
            $updated_member->update($data);
            $member_data = Member::findorFail($member);
        }
        else
            {
                $member_data = 'user not found';
            }

        return response()->json(['data' => $member_data]);

    }
}