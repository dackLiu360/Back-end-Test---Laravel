<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\States;
use Illuminate\Http\Request;

class StatesController extends Controller{

    const ID = 'id';
    const STATE = 'state';
    
    /**
     * Get the state by the given id
     */
    public function read(Request $request){ 
        $data = States::where(self::ID, $request->id)->first();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * Get all the states registered
     */
    public function readAll(){ 
        $data = States::select(self::STATE)->distinct()->get();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get the total of users related to certain city
     */
    public function readUsersTotalByCity(Request $request){
        $total = States::where(self::STATE, $request->state)->count();

        return $total;
    }

}