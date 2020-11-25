<?php

namespace App\Repositories\UserRoleRepository;

use App\UserRole;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Insert
{

    protected $userRole;
    protected $data;

    public function __construct(UserRole $userRoleData)
    {
        $this->userRole = DB::table('user_role');
        $this->data = $userRoleData;
    }

    public function Execute()
    {
        $this->data->save();
    }

}
