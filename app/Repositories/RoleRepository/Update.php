<?php

namespace App\Repositories\RoleRepository;

use App\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Update
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
        $this->role->where('id', $this->data->id)
            ->where('deleted_at', null)
            ->update([
                'code' => $this->data->code,
                'name' => $this->data->name,
                'updated_at' => Carbon::now()
            ]);
    }
}
