<?php

namespace App\Repositories\RoleFeatureRepository;

use App\Role;
use App\RoleFeature;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Insert
{
    protected $role;
    protected $data;
    public function __construct(RoleFeature $_dataRF)
    {
        $this->role = DB::table('role_feature');
        $this->data = $_dataRF;
    }
    public function Execute()
    {
        $this->data->save();
        return $this->data->id;
    }
}