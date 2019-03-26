<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'Api\MemberController@login');

Route::get('auth/signup/activate/{token}', 'Api\MemberController@signupActivate');
Route::post('register', 'Api\MemberController@register');

//Route::group(['middleware' => 'auth.jwt'], function () {

Route::middleware(['auth:api'])->group(function () {

    Route::get('/test', function (Request $request) {
        return response()->json([
            'test' => 'test',
        ], 401);
        });


    Route::PUT('/members/{member}','Api\MemberController@update');

    Route::get('/sessions','Api\MemberController@sessions');

    Route::get('/sessions_details','Api\MemberController@sessions_details');

    Route::post('/sessions/{id}/attend','Api\MemberController@attend');


    Route::get('/attendances','Api\MemberController@attendances_history');

});