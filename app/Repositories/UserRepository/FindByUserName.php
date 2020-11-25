<?php

namespace App\Repositories\UserRepository;

use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FindByUserName
{

    protected $user;
    protected $username;

    public function __construct($_username)
    {
        $this->user = DB::table('user');
        $this->username = $_username;
    }

    public function Get()
    {
        $data = $this->user->where('userName', $this->username)
            ->where('deleted_at', null)
            ->first();
        return $data;
    }
}
