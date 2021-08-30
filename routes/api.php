<?php

use Illuminate\Support\Facades\Route;

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

//#############################  users api    ###########################################
Route::post('createUser', 'UsersController@create');
Route::get('findUserById/{id}', 'UsersController@read');
Route::get('findAllUsers/', 'UsersController@readAll');
Route::patch('updateUser/{id}', 'UsersController@update');
Route::delete('deleteUser/{id}',  'UsersController@delete');

//#############################  adresses api    ###########################################
Route::get('findAddressById/{id}', 'AddressesController@read');
Route::get('findAllAddresses',  'AddressesController@readAll');

//#############################  cities api    ###########################################
Route::get('findCityById/{id}', 'CitiesController@read');
Route::get('findAllCities',  'CitiesController@readAll');
Route::get('findUsersTotalByCity/{city}',  'CitiesController@readUsersTotalByCity');

//#############################  states api    ###########################################
Route::get('findStateById/{id}', 'StatesController@read');
Route::get('findAllStates',  'StatesController@readAll');
Route::get('findUsersTotalByState/{state}',  'StatesController@readUsersTotalByState');
