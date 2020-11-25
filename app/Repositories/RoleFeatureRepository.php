<?php

namespace App\Repositories;

use App\RoleFeature;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoleFeatureRepository  {

    protected $roleFeature;

    public function __construct()
    {
        $this->roleFeature = DB::table('role_feature');
    }

    public function FindPerPage($per_page)
    {
        return $this->roroleFeaturele->orderBy('created_at')->paginate($per_page);
    }

    public function FindByID($id)
    {        
        return $this->roleFeature->find($id);
    }
}
