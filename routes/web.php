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

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('users', 'UserController');
});

/**
 * Ban Realted Routes
 */
Route::get('/users/{user}/ban', 'UserController@ban')->name('users.ban');
Route::get('/users/{user}/unban', 'UserController@unban') ->name('users.unban');
Route::get('/home', ['uses'=>'HomeController@index', 'middleware' => 'forbid-banned-user'])->name('home');

Route::get('send','MailController@send')->name('send');

Route::group(['middleware' => ['role:admin|cityManager']], function () {

    /**
     * City Managers Related Routes
     */
    Route::get('/cityMangers','UserController@ShowCityManger')->name('ShowCityMangers');
    Route::post('/cityMangers_table', 'UserController@cityMangers_table');
    /**
     * Cities Related Routes
     */
    Route::resource('cities', 'CityController');
    Route::post('cities_table', 'CityController@cities_table');
    /**
     * Gyms Related Routes
     */
    Route::resource('gyms', 'GymController');
    Route::post('gyms_table', 'GymController@gyms_table');

});

Route::group(['middleware' => 'auth'], function () {
    /**
     * Gym Managers Related Routes
     */
    Route::get('/gymMangers', 'UserController@ShowGymManger')->name('ShowGymMangers');
    Route::post('/gymMangers_table', 'UserController@gymMangers_table');
    Route::get('get_managers/{id}','GymController@get_managers');

    /**
     * Gym Coaches Related Routes
     */
    Route::resource('coaches', 'CoachController');
    Route::post('coaches_table', 'CoachController@coaches_table');

    /**
     * Package Related Routes
     */
    Route::resource('packages', 'PackageController');
    Route::get('data_packages', 'PackageController@get_table');
    Route::get('stripe/package', 'StripeController@stripePackage')->name('stripe.package');
    Route::post('charge_package', 'StripeController@stripePost_package');
    Route::get('stripe/package/fetch', 'StripeController@fetchPackages')->name('fetchPackages');
    /**
     * Session Related Routes
     */
    Route::resource('sessions', 'SessionController');
    Route::get('data_sessions', 'SessionController@get_table');
    Route::get('stripe/session', 'StripeController@stripeSession')->name('stripe.session');
    Route::post('charge_session', 'StripeController@stripePost_session');
    Route::get('stripe/sessions/fetch', 'StripeController@fetchSessions')->name('fetchSessions');
    Route::get('sessions_fetch', 'SessionController@fetchCoaches')->name('fetchCoaches');

    /**
     * Attendance Related Routes
     */
    Route::get('attendances', 'AttendanceController@index')->name('attendances.index');
    Route::post('/attendaces_table', 'AttendanceController@AttendancesTable');

    Route::post('/data_source', function () {
        return datatables()->query(\Illuminate\Support\Facades\DB::table('users'))->toJson();
    });

});






