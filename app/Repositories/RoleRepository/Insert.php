<?php

namespace App\Repositories\RoleRepository;

use App\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Insert
{
    
    protected $role;
    protected $data;

    public function __construct(Role $_dataRole)
    {
        $this->role = DB::table('role');
        $this->data = $_dataRole;
    }

    public function Execute()
    {
        $this->data->save();
        return $this->data->id;
    }

}