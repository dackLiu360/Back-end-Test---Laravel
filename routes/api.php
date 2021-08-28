<?php

use Illuminate\Http\Request;
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
Route::get('findUser/{id}', 'UsersController@read');
Route::patch('updateUser/{id}', 'UsersController@delete');
Route::delete('deleteUser/{id}',  'UsersController@delete');
Route::get('findUsersTotalByCity/{city}',  'UsersController@readUsersTotalByCity');
Route::get('findUsersTotalByState/{state}',  'UsersController@readUsersTotalByState');

//#############################  adresses api    ###########################################
Route::get('findAdressById/{id}', 'AddressesController@read');
Route::get('findAllAdresses',  'AddressesController@readAll');

//#############################  cities api    ###########################################
Route::get('findCityById/{id}', 'CitiesController@read');
Route::get('findAllCities',  'CitiesController@readAll');

//#############################  states api    ###########################################
Route::get('findStateById/{id}', 'StatesController@read');
Route::get('findAllStates',  'StatesController@readAll');