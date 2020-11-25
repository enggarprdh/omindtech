<?php

namespace App\Repositories\RoleFeatureRepository;

use App\RoleFeature;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FindByRoleId
{

    protected $roleFeature;
    protected $roleId;
    protected $featureId;

    public function __construct($_featureId, $_roleId)
    {
        $this->roleFeature = DB::table('role_feature');
        $this->roleId = $_roleId;
        $this->featureId = $_featureId;
    }

    public function Get()
    {
        $data = $this->roleFeature->where('role_id', $this->roleId)
            ->where('feature_id', $this->featureId)
            ->where('deleted_at', null)
            ->first();
        return $data;
    }
}
