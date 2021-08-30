<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;

class AddressesController extends MethodsDefaultController
{
    /**
     * Get the adress by the given id
     */
    public function read(Request $request)
    {
        try {
            if(empty($data = $this->getAddressById($request->id))){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_ADDRESS_ID);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json($data);
    }

    /**
     * Get all the adresses registered
     */
    public function readAll(Request $request)
    {
        try {
            if(empty($data = response()->json($this->getAddressesName()))){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_ADDRESS);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return $data;
    }
}
