<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');
Route::get('/logout', 'HomeController@getLogout');
Route::get('/dashboard', 'HomeController@getDashboard');
Route::post('auth', 'HomeController@getAuth');

Route::controller('regions', 'RegionsController');
Route::post('regions', 'RegionsController@getSave');

Route::controller('cities', 'CitiesController');
Route::post('cities', 'CitiesController@getSave');

Route::controller('provinces', 'ProvincesController');
Route::post('provinces', 'ProvincesController@getSave');

Route::controller('countries', 'CountriesController');
Route::post('countries', 'CountriesController@getSave');

Route::controller('employee', 'EmployeeController');
Route::post('employee', 'EmployeeController@getSave');

Route::controller('guest', 'GuestController');
Route::post('guest', 'GuestController@getSave');

Route::controller('hotel', 'HotelController');
Route::post('hotel', 'HotelController@getSave');

Route::controller('identity', 'IdentityController');
Route::post('identity', 'IdentityController@getSave');

Route::controller('job', 'JobController');
Route::post('job', 'JobController@getSave');

Route::controller('type', 'TypeController');
Route::post('type', 'TypeController@getSave');

Route::controller('rooms', 'RoomsController');
Route::post('rooms', 'RoomsController@getSave');

Route::controller('services', 'ServicesController');
Route::post('services', 'ServicesController@getSave');

Route::controller('users', 'UsersController');
Route::post('users', 'UsersController@getSave');

Route::controller('bookings', 'BookingController');
Route::post('bookings', 'BookingController@getSave');

Route::controller('payments', 'PaymentsController');
