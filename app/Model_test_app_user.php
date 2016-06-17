<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Model_test_app_user extends Authenticatable
{

    protected $table = 'test_app_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'age','photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}

