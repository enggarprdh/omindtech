<?php

namespace App\Repositories\RoleRepository;

use App\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleDropdown
{
    
    protected $tenantID;

    public function __construct()
    {
        $this->tenantID = auth()->user()->tenant_id;
    }

    public function Get()
    {
        $result = Role::where('deleted_at',null)
                        ->where('tenant_id',$this->tenantID)
                        ->whereNotIn('id',[1])
                        ->get(['id','name AS text']);

        return $result;
    }

}