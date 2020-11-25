<?php
namespace App\BussinessLogic\UserBL;

use App\Helper\GenerateUUID;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use stdClass;
use App\User;
use Throwable;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use App\UserRole;

class InsertUser
{
    protected $userData;
    protected $result;
    protected $message;
    protected $generator;
    protected $tenantID;

    public function __construct($param)
    {
        
        $this->userData = $param;
        $this->result = false;
        $this->message = "Error!";
        $this->generator = new GenerateUUID;
        $this->tenantID = auth()->user()->tenant_id;
    }

    public function Save()
    {
        $userRepo = new UserRepository\FindByUserName($this->userData['email']);
        $userInfo = $userRepo->Get();
        if ($userInfo == null) {
            DB::beginTransaction();
            try {
                $userID = $this->generator->ver1();
                $user = new User();
                $user->id = $userID;
                $user->tenant_id = $this->tenantID;
                $user->firstName = $this->userData['firstName'];
                if ($this->userData['lastName'] != null) {
                    $user->lastName = $this->userData['lastName'];
                } else {
                    $user->lastName = "";
                }
                $user->userName = $this->userData['email'];
                $user->password = Hash::make($this->userData['password']);
                $user->isActive = true;
                $userRepo = new UserRepository\Insert($user);
                $userRepo->Execute();
                $userRole = new UserRole();
                $userRole->id = $this->generator->ver1();
                $userRole->user_id = $userID;
                $userRole->role_id = $this->userData['roleId'];
                $userRole->isActive = true;
                $userRoleRepo = new UserRoleRepository\Insert($userRole);
                $userRoleRepo->Execute();
                DB::commit();
                $response = new stdClass();
                $response->result = true;
                $response->message = trans('user.user_save_success');
                return $response;
            } catch (Throwable $ex) {
                DB::rollBack();
                $response = new stdClass();
                $response->result = $this->result;
                $response->message = $ex;
                return $response;
            }
        } else {
            $response = new stdClass();

            $response->result = $this->result;
            $response->message = trans('user.user_already_exist');
            return $response;
        }
    }
}
