<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    public $timestamps = false;
    protected $table  = 'addresses';
    protected $fillable = [
        'fk_user',
        'address'
    ];
}
