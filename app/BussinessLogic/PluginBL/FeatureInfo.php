<?php

namespace App\BussinessLogic\PluginBL;

use App\Repositories\UserRoleRepository;
use Illuminate\Support\Facades\DB;
use stdClass;

class FeatureInfo
{
    protected $feature_id;
    public function __construct($_featureID)
    {
        $this->feature_id = $_featureID;
    }

    public function Get()
    {
        $query = DB::table('plugin as p')
            ->join('feature as f', 'p.ID', '=', 'f.plugin_id')
            ->join('tenant_plugin as tp', 'tp.plugin_id', '=', 'p.id')
            ->where('f.id', $this->feature_id)
            ->where('f.deleted_at', null)
            ->select('p.id as plugin_id', 'p.pluginName', 'f.id as feature_id', 'f.featureName')
            ->get();
        return $query;
    }
    public function GetByRole($roleID)
    {
        
    }
}
