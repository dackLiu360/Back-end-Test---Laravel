<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Cities;
use App\Models\States;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller {

    /**
     * Registers an user data 
     */
    public function create(Request $request){  

        $users = new Users;
        $addresses = new Addresses;
        $cities = new Cities;
        $states = new States;

        $users->username = $request->username;
        $users->password = $request->password;
        $addresses->address = $request->address;
        $cities->city = $request->city;
        $states->state = $request->state;        

        $users->save();

        $addresses->fk_user = $users->id;
        $cities->fk_user = $users->id;
        $states->fk_user = $users->id;

        $addresses->save();
        $cities->save();
        $states->save();

        return true;
    }

    /**
     * Get an user by the given id
     */
    public function read(Request $request){

        $read = Users::where('id', $request->id)->first();

        return $read;
 
    }

    /**
     * Updates an user info by the given id
     */
    public function update(Request $request){ 

        $users = new Users;
        $addresses = new Addresses;
        $cities = new Cities;
        $states = new States;

        $id = $request->id;

        if((isset($request->username) ? $users->username = $request->username : false) ||
        (isset($request->password) ? $users->password = $request->password : false)){
            $users->where('id', $id)->update();
        }

        if(isset($request->address) ? $addresses->address = $request->address : false){
            $addresses->where('fk_user', $id)->update();
        }

        if(isset($request->city) ? $cities->city = $request->city : false){
            $cities->where('fk_user', $id)->update();
        }

        if(isset($request->state) ? $states->state = $request->state : false){
            $states->where('fk_user', $id)->update();
        }

        return true;
    }

    /**
     *  Deletes an user by the given id
     */
    public function delete(Request $request){ 
    }

    /**
     * Get the total of users related to certain city
     */
    public function readUsersTotalByCity(Request $request){
    }

    /**
     * Get the total of users related to certain state
     */
    public function readUsersTotalByState(Request $request){
    }
}