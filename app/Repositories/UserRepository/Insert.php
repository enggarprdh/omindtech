<?php

namespace App\Repositories\UserRepository;

use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Insert
{

    protected $user;
    protected $data;

    public function __construct(User $userData)
    {
        $this->user = DB::table('user');
        $this->data = $userData;
    }

    public function Execute()
    {
        $this->data->save();
    }

}
