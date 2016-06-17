<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Avatar extends Authenticatable
{

    protected $table = 'avatar';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
