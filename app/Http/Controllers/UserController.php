<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    /**
     * Registers an user data 
     */
    public function create(Request $request){ 
    }

    /**
     * Get an user by the given id
     */
    public function read(Request $request){ 
    }

    /**
     * Updates an user info by the given id
     */
    public function update(Request $request){ 
    }

    /**
     *  Deletes an user by the given id
     */
    public function delete(Request $request){ 
    }

    /**
     * Get the total of users related to certain city
     */
    public function readUsersTotalByCity(Request $request){
    }

    /**
     * Get the total of users related to certain state
     */
    public function readUsersTotalByState(Request $request){
    }
}