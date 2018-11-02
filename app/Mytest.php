<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mytest extends Model
{
    protected $fillable = [
        'name', 'cnum', 'email', 'address',
    ];
}

