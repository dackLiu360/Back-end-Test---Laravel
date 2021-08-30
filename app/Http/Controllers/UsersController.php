<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;

class UsersController extends MethodsDefaultController
{
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

            if ($this->getUserByUsername($request->username)) {
                throw new InvalidArgumentException(self::ERROR_ALREADY_EXISTS);
            }

            $this->insertUser($request->username, $request->password, $request->address, $request->city, $request->state);
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
            if (empty($data = $this->getUserById($request->id))) {
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_USER_ID);
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
            if (empty(response()->json($users = $this->getUsersIdUsername()))) {
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_USER);
            }

            $data = [];

            foreach ($users as $k => $user) {
                $data[$k][self::USERNAME] = $user->username;
                $data[$k][self::PASSWORD] = self::HIDE_PASSWORD;
                $data[$k][self::ADDRESS] = $this->getAddressByUserId($user->id);
                $data[$k][self::CITY] = $this->getCityByUserId($user->id);
                $data[$k][self::STATE] = $this->getStateByUserId($user->id);
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
            if (empty($this->getUserById($request->id))) {
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_USER_ID);
            }

            $params = [
                'username' => empty($request->username) ? false : $request->username,
                'password' => empty($request->password) ? false : $request->password,
                'address' => empty($request->address) ? false : $request->address,
                'city' => empty($request->city) ? false : $request->city,
                'state' => empty($request->state) ? false : $request->state,
            ];

            if (
                !$params['username'] && !$params['password'] && !$params['address'] &&
                !$params['city'] && !$params['state']
            ) {
                throw new InvalidArgumentException(self::ERROR_FILLED_NONE);
            }

            $this->updateFields($request->id, $params);
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
            if (empty($request->id) || empty($this->deleteUserInfo($request->id))) {
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_USER_ID);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(self::SUCCESS_DELETE);
    }
}
