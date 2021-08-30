<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Cities;
use App\Models\States;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Hash;

class MethodsDefaultController extends Controller
{
    const ID = 'id';
    const ADDRESS = 'address';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const CITY = 'city';
    const STATE = 'state';
    const FK_USER = 'fk_user';
    const TOTAL_STATES = 'The total of users registered by the given state found was: ';
    const TOTAL_CITIES = 'The total of users registered by the given city found was: ';
    const ERROR_FILLED = 'All the fields must be filled before submit a new user!';
    const ERROR_FILLED_NONE = 'At least one field must be filled !';
    const ERROR_ALREADY_EXISTS = 'Username already exists, please chose another!';
    const ERROR_NOT_FOUND_USER = 'No user was found!';
    const ERROR_NOT_FOUND_USER_ID = 'No user was found by the given id!';
    const ERROR_NOT_FOUND_ADDRESS_ID = 'No address was found by the given id!';
    const ERROR_NOT_FOUND_ADDRESS = 'No address was found!';
    const ERROR_NOT_FOUND_CITY_ID = 'No city was found by the given id!';
    const ERROR_NOT_FOUND_CITY = 'No city was found!';
    const ERROR_NOT_FOUND_STATE_ID = 'No state was found by the given id!';
    const ERROR_NOT_FOUND_STATE = 'No state was found!';
    const SUCCESS_CREATE = 'User was succesfully created!';
    const SUCCESS_DELETE = 'User was succesfully deleted!';
    const SUCCESS_UPDATE = 'User was succesfully updated!';
    const HIDE_PASSWORD = '******';

    //Users methods
    protected function insertUser($username, $password, $address, $city, $state)
    {
        try {
            $user = Users::create([
                self::USERNAME => $username,
                self::PASSWORD => Hash::make($password)
            ]);

            Addresses::create([
                self::FK_USER => $user->id,
                self::ADDRESS => $address
            ]);

            Cities::create([
                self::FK_USER => $user->id,
                self::CITY => $city
            ]);

            States::create([
                self::FK_USER => $user->id,
                self::STATE => $state
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getUserByUsername($username)
    {
        try {
            return Users::where(self::USERNAME, $username)->first();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getUserById($id)
    {
        try {
            return Users::select('username')->where(self::ID, $id)->first();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getUsersIdUsername()
    {
        try {
            return Users::get(['id', 'username']);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function updateFields($id, $params)
    {
        try {
            foreach ($params as $field => $param) {
                switch ($field) {
                    case 'username':
                        Users::where(self::ID, $id)
                            ->update([self::USERNAME => $param]);
                        break;

                    case 'password':
                        Users::where(self::ID, $id)
                            ->update([self::PASSWORD => Hash::make($param)]);
                        break;

                    case 'address':
                        Addresses::where(self::FK_USER, $id)
                            ->update([self::ADDRESS => $param]);
                        break;

                    case 'city':
                        Cities::where(self::FK_USER, $id)
                            ->update([self::CITY => $param]);
                        break;

                    case 'state':
                        States::where(self::FK_USER, $id)
                            ->update([self::STATE => $param]);
                        break;
                }
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function deleteUserInfo($id)
    {
        try {
            return Users::where(self::ID, $id)->delete();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    //Addresses methods
    protected function getAddressById($id)
    {
        try {
            return Addresses::select(self::ADDRESS)->where(self::ID, $id)->first();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getAddressesName()
    {
        try {
            return Addresses::select(self::ADDRESS)->distinct()->get();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getAddressByUserId($id)
    {
        try {
            return Addresses::select(self::ADDRESS)
                ->where(self::FK_USER, $id)
                ->first()->address;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    //Cities methods
    protected function getCityById($id)
    {
        try {
            return Cities::select(self::CITY)->where(self::ID, $id)->first();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getCitiesName()
    {
        try {
            return Cities::select(self::CITY)->distinct()->get();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getCityByUserId($id)
    {
        try {
            return Cities::select(self::CITY)
                ->where(self::FK_USER, $id)
                ->first()->city;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getTotalUsersByCity($city)
    {
        try {
            return Cities::where(self::CITY, $city)->count();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    //States methods
    protected function getStateById($id)
    {
        try {
            return States::select(self::STATE)->where(self::ID, $id)->first();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getStateByUserId($id)
    {
        try {
            return States::select(self::STATE)
                ->where(self::FK_USER, $id)
                ->first()->state;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getStatesName()
    {
        try {
            return States::select(self::STATE)->distinct()->get();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    protected function getTotalUsersByState($state)
    {
        try {
            return States::where(self::STATE, $state)->count();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
