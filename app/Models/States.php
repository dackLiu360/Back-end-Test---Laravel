<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    public $timestamps = false;
    protected $table  = 'states';
    protected $fillable = [
        'fk_user',
        'state'
    ];
}