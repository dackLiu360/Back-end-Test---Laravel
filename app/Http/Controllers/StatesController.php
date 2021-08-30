<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;

class StatesController extends MethodsDefaultController
{
    /**
     * Get the state by the given id
     */
    public function read(Request $request)
    {
        try {
            if(empty($data = $this->getStateById($request->id))){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_STATE_ID);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json($data);
    }

    /**
     * Get all the states registered
     */
    public function readAll()
    {
        try {
            if(empty($data = response()->json($this->getStatesName()))){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_STATE);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return $data;
    }

    /**
     * Get the total of users related to certain city
     */
    public function readUsersTotalByState(Request $request)
    {
        try {
            $data = $this->getTotalUsersByState($request->state);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(self::TOTAL_STATES . $data);
    }
}
