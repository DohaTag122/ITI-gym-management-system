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


//! Please write your Routes on your specified space to avoid merge conflicts
//*Ziad Routes

Route::get('attendances', 'AttendanceController@index')->name('attendances.index');
Route::post('/attendaces_table','AttendanceController@AttendancesTable');

//Route::get('/relation', function () {
//    $city = \App\City::find('1');
//    dd($city->City_manager->count());
////    $sessions = \App\Session::first();
////    $packages = \App\Package::first();
//
////    dd($sessions->packages);
////    dd($packages->sessions);
//
////    dd($packages->sessions);
//});

/*
Route::get('/home', function () {
    return view('home');
});*/

Route::post('/data_source', function () {
    return datatables()->query(\Illuminate\Support\Facades\DB::table('users'))->toJson();
});

Route::DELETE('/users/{user}/delete','UserController@delete');









//Doha Routes
Route::resource('users', 'UserController');
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('users', 'UserController@index')->name('users.index');
});

 Route::get('/user/create', 'UserController@create')
->name('users.create');
 Route::post('/store', 'UserController@store')
 ->name('users.store');
  Route::get('/users/{id}/show', 'UserController@show')
->name('users.show');
  Route::get('/users/{id}/edit', 'UsersController@edit')
  ->name('users.edit');
  Route::put('/users/{id}', 'UsersController@update')
  ->name('users.update');

 Route::get('/users/{user}/ban', 'UserController@ban')
 ->name('users.ban');
 Route::get('/users/{user}/unban', 'UserController@unban')
 ->name('users.unban');
 Route::get('/home', ['uses'=>'HomeController@index', 'middleware' => 'forbid-banned-user'])->name('home');
Route::get('send','MailController@send')->name('send');
Route::group(['middleware' => ['role:admin|cityManager']], function () {
   
    Route::get('/cityMangers','UserController@ShowCityManger')->name('ShowCityMangers');
    Route::post('/cityMangers_table', 'UserController@cityMangers_table');

});


   
    
Route::get('/gymMangers','UserController@ShowGymManger')->name('ShowGymMangers');
Route::post('/gymMangers_table', 'UserController@gymMangers_table');








//* Nour Routes
Route::resource('packages', 'PackageController');
Route::get('data_packages', 'PackageController@get_table');
Route::resource('sessions', 'SessionController');
Route::get('data_sessions', 'SessionController@get_table');
Route::get('stripe/package', 'StripeController@stripePackage')->name('stripe.package');
Route::get('stripe/session', 'StripeController@stripeSession')->name('stripe.session');
Route::post('charge', 'StripeController@stripePost');
Route::post('stripe/package/fetch', 'StripeController@fetchPackages')->name('fetchPackages');
Route::post('stripe/sessions/fetch', 'StripeController@fetchSessions')->name('fetchSessions');










//*Sherouk Routes


Route::group(['middleware' => 'auth'], function () {


Route::resource('cities', 'CityController');
Route::post('cities_table', 'CityController@cities_table');

Route::resource('gyms', 'GymController');
Route::post('gyms_table', 'GymController@gyms_table');
Route::get('get_managers/{id}','GymController@get_managers');

Route::resource('coaches', 'CoachController');
Route::post('coaches_table', 'CoachController@coaches_table');
});
Auth::routes();





