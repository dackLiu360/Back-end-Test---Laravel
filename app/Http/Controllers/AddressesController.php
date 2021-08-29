<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;

class AddressesController extends Controller
{

    const ID = 'id';
    const ADDRESS = 'address';
    const ERROR_NOT_FOUND_ID = 'No address was found by the given id!';
    const ERROR_NOT_FOUND = 'No address was found!';

    /**
     * Get the adress by the given id
     */
    public function read(Request $request)
    {
        try {
            if(empty($data = Addresses::select(self::ADDRESS)->where(self::ID, $request->id)->first())){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND_ID);
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
            if(empty($data = response()->json(Addresses::select(self::ADDRESS)->distinct()->get()))){
                throw new InvalidArgumentException(self::ERROR_NOT_FOUND);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return $data;
    }
}
