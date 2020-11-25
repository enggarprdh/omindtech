<?php

namespace App\Repositories\RoleRepository;

use App\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Delete
{

    protected $role;
    protected $id;

    public function __construct($_id)
    {
        $this->role = DB::table('role');
        $this->id = $_id;
    }

    public function Execute()
    {
        $this->role->where('id', $this->id)
            ->where('deleted_at', null)
            ->update([
                'deleted_at' => Carbon::now()
            ]);
    }
}
