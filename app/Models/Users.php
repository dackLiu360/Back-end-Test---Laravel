<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;
    protected $table  = 'users';
    protected $fillable = [
        'username',
        'password'
    ];

    public static function findUsersTotalByCity($name){
    }

    public static function findUsersTotalByStates($name){
    }
}