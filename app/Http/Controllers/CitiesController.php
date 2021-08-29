<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\Request;

class CitiesController extends Controller{
    
    const ID = 'id';
    const CITY = 'city';

    /**
     * Get the city by the given id
     */
    public function read(Request $request){ 
        $data = Cities::where(self::ID, $request->id)->first();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * Get all the cities registered
     */
    public function readAll(Request $request){ 
        $data = Cities::select(self::CITY)->distinct()->get();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get the total of users related to certain city
     */
    public function readUsersTotalByCity(Request $request){
        $total = Cities::where(self::CITY, $request->city)->count();

        return $total;
    }
}