<?php

namespace App\Repositories\RoleFeatureRepository;

use App\Role;
use App\RoleFeature;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Delete
{

    protected $roleFeature;
    protected $roleID;


    public function __construct($role_id)
    {
        $this->roleFeature = DB::table('role_feature');
        $this->roleID = $role_id;
    }

    public function Execute()
    {
        $this->roleFeature->where('role_id', $this->roleID)
            ->where('deleted_at', null)
            ->update([
                'deleted_at' => Carbon::now()
            ]);
    }
}
