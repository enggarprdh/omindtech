<?php

namespace App\Repositories\UserRepository;

use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Status
{

    protected $user;
    protected $id;

    public function __construct($_id)
    {
        $this->user = DB::table('user');
        $this->id = $_id;
    }

    public function Change()
    {
        $status = false;

        $userInfo = User::find($this->id);

        if ($userInfo != null) {
            if ($userInfo->isActive == true) {
                $status = false;
            } else {
                $status = true;
            }

            $this->user->where('id', $this->id)
                ->where('deleted_at', null)
                ->update([
                    'isActive' => $status,
                    'updated_at' => Carbon::now()
                ]);
        }
    }
}
