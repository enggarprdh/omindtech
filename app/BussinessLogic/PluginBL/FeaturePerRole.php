<?php

namespace App\BussinessLogic\PluginBL;

use App\Repositories\UserRoleRepository;
use Illuminate\Support\Facades\DB;
use stdClass;

class FeaturePerRole
{
    protected $roleID;
    public function __construct($_roleID)
    {
        $this->roleID = $_roleID;
    }
    public function Get()
    {
        $query = DB::table('plugin as p')
            ->join('feature as f', 'p.ID', '=', 'f.plugin_id')
            ->join('role_feature as rf', 'rf.feature_id', '=', 'f.id')
            ->where('rf.role_id', $this->roleID)
            ->where('rf.deleted_at', null)
            ->select('p.id as plugin_id', 'p.pluginName as pluginName', 'f.id as feature_id', 'f.featureName', 'rf.canCreate', 'rf.canRead', 'rf.canUpdate', 'rf.canDelete')
            ->get();
        foreach($query as $item)
        {
            $item->pluginName = trans($item->pluginName);
            $item->featureName = trans($item->featureName);
        }
        return $query;
    }
}


