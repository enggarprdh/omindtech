<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;

class UserRoleRepository
{
    protected $userRole;

    public function __construct()
    {
        $this->userRole = DB::table('user_role');
    }

    public function FindByUserID($userID)
    {
        
        $query = $this->userRole->where('user_id', $userID)
                                ->where('deleted_at',null)
                                ->first();
        return $query;

    }
}