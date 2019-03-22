<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//! Please write your Routes on your specified space to avoid merge conflicts
//*Ziad Routes

Route::get('/relation', function () {
    $sessions = \App\Session::first();
    $packages = \App\Package::first();

//    dd($sessions->packages);
    dd($packages->sessions);

//    dd($packages->sessions);
});


Route::get('/test', function () {
    return view('home');
});

Route::post('/data_source', function () {
    return datatables()->query(\Illuminate\Support\Facades\DB::table('users'))->toJson();
});

Route::DELETE('/users/{user}',function ($user) {

    $user_data = \App\User::find($user);
    \App\User::find($user)->delete();
    return response()->json(array('user'=>$user_data));
});










//*Doha Routes

















//* Nour Routes
Route::resource('package', 'PackageController');
Route::get('data_packages', 'PackageController@get_table');











//*Sherouk Routes


Route::group(['middleware' => 'auth'], function () {


Route::resource('cities', 'CityController');


Route::post('cities_table', 'CityController@cities_table');


});
Auth::routes();





