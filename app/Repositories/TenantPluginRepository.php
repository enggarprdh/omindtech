<?php

namespace App\Repositories;

use App\TenantPlugin;
use App;

class TenantPluginRepository
{

    protected $tenantPlugin;

    public function __construct()
    {
        
    }

    public function GetTenantPlugin($tenantID)
    {
        $data = TenantPlugin::where('tenant_id', auth()->user()->tenant_id)
                                   ->where('deleted_at', null)
                                   ->get();
        return $data;
        
    }
}
