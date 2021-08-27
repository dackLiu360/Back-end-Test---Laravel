<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table  = 'users';

    public static function insert($params){
    }

    public static function findById($id){
    }

    public static function updateById($id, $params){
    }

    public static function removeById($id){
    }

    public static function findUsersTotalByCity($name){
    }

    public static function findUsersTotalByStates($name){
    }
}
