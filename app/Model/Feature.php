<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    //
    protected $table = "feature";
    protected $hidden = ['created_at','deleted_at','updated_at'];
}
