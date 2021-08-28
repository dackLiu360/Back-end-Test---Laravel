<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $table  = 'users';
    protected $fillable = [
        'fk_user',
        'username'
    ];

    public static function findUsersTotalByCity($name){
    }

    public static function findUsersTotalByStates($name){
    }
}