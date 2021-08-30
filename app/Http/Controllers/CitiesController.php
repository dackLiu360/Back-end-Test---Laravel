<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;

class CitiesController extends Controller
{

    const ID = 'id';
    const CITY = 'city';
    const ERROR_NOT_FOUND_ID = 'No city was found by the given id!';
    const ERROR_NOT_FOUND = 'No city was found!';
    const TOTAL_CITIES = 'The total of users registered by the given city found was: ';

    /**
     * Get the city by the given id
     */
    public function read(Request $request)
    {
        try {
            if(empty($data = Cities::select(self::CITY)->where(self::ID, $request->id)->first())){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_ID);
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
            if(empty($data = response()->json(Cities::select(self::CITY)->distinct()->get()))){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND);
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
            $name = str_replace('%', ' ', $name);
            $data = Cities::where(self::CITY, $name)->count();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(self::TOTAL_CITIES . $data);
    }
}
