<?php 


namespace App\BussinessLogic\PluginBL;

use App\Repositories\UserRoleRepository;
use Illuminate\Support\Facades\DB;



class MenuPlugin 
{

    protected $userID;

    public function __construct($_userID)
    {
        $this->userID = $_userID;
    }
    //untuk ambil menu navigasi
    public function Get()
    {
        $userRoleRepo = new UserRoleRepository;

        $userRoleInfo = $userRoleRepo->FindByUserID($this->userID);

        $dataPlugin = DB::table('plugin as p')
            ->join('feature as f', 'p.id', '=', 'f.plugin_id')
            ->join('role_feature as rf', 'f.id', '=', 'rf.feature_id')
            ->where('rf.role_id', '=', $userRoleInfo->role_id)
            ->where('rf.deleted_at', null)
            ->select('p.id as plugin_id', 'p.order', 'p.pluginName', 'p.icon as plugin_icon', 'p.displayName', 'f.id', 'f.featureName', 'f.urlPath', 'f.icon as feature_icon')
            ->orderBy('p.order')
            ->get();

        return $dataPlugin;
    }
}

