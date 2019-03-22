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
//Ziad Routes



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










//Doha Routes

















//Nour Routes











//Sherouk Routes

Route::group(['middleware' => 'auth'], function () {

Route::resource('cities', 'CityController');
Route::post('cities_table', 'CityController@cities_table');
//Route::resource('gyms', 'GymController');
});

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/cities', 'CityController@index')
//     ->name('cities.index')
//     ;
//     Route::get('/cities/create', 'CityController@create')
//     ->name('cities.create')
   
//     ;
//     Route::post('/cities', 'CityController@store')
//     ->name('cities.store')
//     ;
//     Route::get('/cities/{city}/edit', 'CityController@edit')
//     ->name('cities.edit')
//     ;
// });


// Route::put('/cities/{city}','CityController@update')->name('cities.update');
// Route::delete('/cities/{city}','CityController@destroy')->name('cities.destroy');
// Route::get('/cities/{city}','CityController@show')->name('cities.show');

Auth::routes();





