<?php

namespace App\Repositories\RoleRepository;

use App\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Status
{

    protected $role;
    protected $id;

    public function __construct($_id)
    {
        $this->role = DB::table('role');
        $this->id = $_id;
    }

    public function Change()
    {
        $status = false;

        $roleInfo = $this->role->find($this->id);

        if ($roleInfo != null) {

            if ($roleInfo->isActive == true) {
                $status = false;
            } else {
                $status = true;
            }

            $this->role->where('id', $this->id)
                ->where('deleted_at', null)
                ->update([
                    'isActive' => $status,
                    'updated_at' => Carbon::now()
                ]);
        }
    }
}
