<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Cities;
use App\Models\States;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller {

    const USERNAME = 'username';
    const PASSWORD = 'password';
    const ADDRESS = 'address';
    const CITY = 'city';
    const STATE = 'state';
    const FK_USER = 'fk_user';
    const ID = 'id';

    /**
     * Registers an user data 
     */
    public function create(Request $request){  
        $user = Users::create([
            self::USERNAME => $request->username,
            self::PASSWORD => $request->password
        ]);

        Addresses::create([
            self::FK_USER => $user->id,
            self::ADDRESS => $request->address
        ]);

        Cities::create([
            self::FK_USER => $user->id,
            self::CITY => $request->city
        ]);

        States::create([
            self::FK_USER => $user->id,
            self::STATE => $request->state
        ]);

        return true;
    }

    /**
     * Get an user by the given id
     */
    public function read(Request $request){
        $data = Users::where(self::ID, $request->id)->first();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get all the users and infos
     */
    public function readAll(Request $request){
        $users = Users::get();
        $data = [];

        foreach ($users as $k => $user) {
            $data[$k][self::USERNAME] = $user->username;
            $data[$k][self::PASSWORD] = $user->password;
            $data[$k][self::ADDRESS] = Addresses::select(self::ADDRESS)->where(self::FK_USER, $user->id)->first()->address;
            $data[$k][self::CITY] = Cities::select(self::CITY)->where(self::FK_USER, $user->id)->first()->city;
            $data[$k][self::STATE] = States::select(self::STATE)->where(self::FK_USER, $user->id)->first()->state;
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Updates an user info by the given id
     */
    public function update(Request $request){ 
        if(isset($request->username)){
            Users::where(self::ID, $request->id)
            ->update([self::USERNAME => $request->username]);
        }

        if(isset($request->password)){
            Users::where(self::ID, $request->id)
            ->update([self::PASSWORD => $request->password]);
        }

        if(isset($request->address)){
            Addresses::where(self::FK_USER, $request->id)
            ->update([self::ADDRESS => $request->address]);
        }

        if(isset($request->city)){
            Cities::where(self::FK_USER, $request->id)
            ->update([self::CITY => $request->city]);
        }

        if(isset($request->state)){
            States::where(self::FK_USER, $request->id)
            ->update([self::STATE => $request->state]);
        }

        return true;
    }

    /**
     *  Deletes an user by the given id
     */
    public function delete(Request $request){ 
        Users::where(self::ID, $request->id)
        ->delete();

        return true;
    }
}