<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Cities;
use App\Models\States;
use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{

    const USERNAME = 'username';
    const PASSWORD = 'password';
    const ADDRESS = 'address';
    const CITY = 'city';
    const STATE = 'state';
    const FK_USER = 'fk_user';
    const ID = 'id';
    const ERROR_FILLED = 'All the fields must be filled before submit a new user!';
    const ERROR_FILLED_NONE = 'At least one field must be filled !';
    const ERROR_ALREADY_EXISTS = 'Username already exists, please chose another!';
    const ERROR_NOT_FOUND = 'No user was found!';
    const ERROR_NOT_FOUND_ID = 'No user was found by the given id!';
    const SUCCESS_CREATE = 'User was succesfully created!';
    const SUCCESS_DELETE = 'User was succesfully deleted!';
    const SUCCESS_UPDATE = 'User was succesfully updated!';
    const HIDE_PASSWORD = '******';

    /**
     * Registers an user data 
     */
    public function create(Request $request)
    {
        try {
            if (
                empty($request->username) || empty($request->password) || empty($request->address) ||
                empty($request->city) ||  empty($request->state)
            ) {
                throw new InvalidArgumentException(self::ERROR_FILLED);
            }

            if(Users::where(self::USERNAME, $request->username)->first()){
                throw new InvalidArgumentException(self::ERROR_ALREADY_EXISTS);
            }

            $user = Users::create([
                self::USERNAME => $request->username,
                self::PASSWORD => Hash::make($request->password)
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
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(self::SUCCESS_CREATE);
    }

    /**
     * Get an user by the given id
     */
    public function read(Request $request)
    {
        try {
            if(empty($data = Users::select('username')->where(self::ID, $request->id)->first())){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_ID);
            }
            $data['password'] = self::HIDE_PASSWORD;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json($data);
    }

    /**
     * Get all the users and infos
     */
    public function readAll(Request $request)
    {
        try {
            $users = Users::get(['id', 'username']);

            if(empty(response()->json($users))){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND);
            }

            $data = [];

            foreach ($users as $k => $user) {
                $data[$k][self::USERNAME] = $user->username;
                $data[$k][self::PASSWORD] = self::HIDE_PASSWORD;
                $data[$k][self::ADDRESS] = Addresses::select(self::ADDRESS)
                    ->where(self::FK_USER, $user->id)
                    ->first()
                    ->address;
                $data[$k][self::CITY] = Cities::select(self::CITY)
                    ->where(self::FK_USER, $user->id)
                    ->first()
                    ->city;
                $data[$k][self::STATE] = States::select(self::STATE)
                    ->where(self::FK_USER, $user->id)
                    ->first()
                    ->state;
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json($data);
    }

    /**
     * Updates an user info by the given id
     */
    public function update(Request $request)
    {
        try {
            if(empty(Users::where(self::ID, $request->id)->first())){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_ID);
            }

            if (
                empty($request->username) && empty($request->password) && empty($request->address) &&
                empty($request->city) && empty($request->state)
            ) {
                throw new InvalidArgumentException(self::ERROR_FILLED_NONE);
            }

            if (isset($request->username)) {
                Users::where(self::ID, $request->id)
                    ->update([self::USERNAME => $request->username]);
            }

            if (isset($request->password)) {
                Users::where(self::ID, $request->id)
                    ->update([self::PASSWORD => Hash::make($request->password)]);
            }

            if (isset($request->address)) {
                Addresses::where(self::FK_USER, $request->id)
                    ->update([self::ADDRESS => $request->address]);
            }

            if (isset($request->city)) {
                Cities::where(self::FK_USER, $request->id)
                    ->update([self::CITY => $request->city]);
            }

            if (isset($request->state)) {
                States::where(self::FK_USER, $request->id)
                    ->update([self::STATE => $request->state]);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(self::SUCCESS_UPDATE);
    }

    /**
     *  Deletes an user by the given id
     */
    public function delete(Request $request)
    {
        try {
            if(empty($request->id) || empty(Users::where(self::ID, $request->id)->delete())){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_ID);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(self::SUCCESS_DELETE);
    }
}
