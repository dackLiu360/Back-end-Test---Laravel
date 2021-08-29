<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use Illuminate\Http\Request;

class AddressesController extends Controller{

    const ID = 'id';
    const ADDRESS = 'address';

    /**
     * Get the adress by the given id
     */
    public function read(Request $request){ 
        $data = Addresses::where(self::ID, $request->id)->first();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * Get all the adresses registered
     */
    public function readAll(Request $request){ 
        $data = Addresses::select(self::ADDRESS)->distinct()->get();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}