<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //    
    protected $table = 'user';
    protected $hidden = ['password','created_at','deleted_at','updated_at'];
    public $incrementing = false;

    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }
}
