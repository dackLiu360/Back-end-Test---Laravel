<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;

class CitiesController extends MethodsDefaultController
{
    /**
     * Get the city by the given id
     */
    public function read(Request $request)
    {
        try {
            if (empty($data = $this->getCityById($request->id))) {
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_CITY_ID);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json($data);
    }

    /**
     * Get all the cities registered
     */
    public function readAll(Request $request)
    {
        try {
            if (empty($data = response()->json($this->getCitiesName()))) {
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_CITY);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return $data;
    }

    /**
     * Get the total of users related to certain city
     */
    public function readUsersTotalByCity(Request $request)
    {
        try {
            $name = urldecode($request->city);
            $data = $this->getTotalUsersByCity($name);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(self::TOTAL_CITIES . $data);
    }
}
