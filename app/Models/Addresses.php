<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $table  = 'adresses';
    protected $fillable = [
        'fk_user',
        'adress'
    ];
}