<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleFeature extends Model
{
    //
    protected $table = "role_feature";
    public $incrementing = false;
    protected $hidden = ['created_at','deleted_at','updated_at'];
}
