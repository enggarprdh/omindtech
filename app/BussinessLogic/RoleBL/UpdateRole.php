<?php

namespace App\BussinessLogic\RoleBL;

use Illuminate\Support\Facades\DB;
use App\Role;
use App\RoleFeature;
use App\Repositories\RoleRepository;
use App\Repositories\RoleFeatureRepository;
use Exception;
use App\Helper;
use App\Helper\GenerateUUID;

class UpdateRole
{
    // protected $roleRepo;
    protected $roleFeatureRepo;
    protected $role;
    protected $roleFeature;
    protected $tenant_id;
    protected $generator;
    public function __construct($_roleInfo, $_roleFeature)
    {
        $this->role = $_roleInfo;
        $this->roleFeature = $_roleFeature;
        $this->tenant_id = auth()->user()->tenant_id;
        $this->generator = new GenerateUUID;
    }

    public function Save()
    {
        
        DB::beginTransaction();

        try {

            $input = new Role;

            $input->id = $this->role['id'];
            $input->name = $this->role['name'];
            $input->code = $this->role['code'];
            $input->tenant_id = $this->tenant_id;

            $roleRepo = new RoleRepository\Update($input);
            $roleRepo->Execute();

            $roleFeatureRepo = new RoleFeatureRepository\Delete($input->id);
            $roleFeatureRepo->Execute();

            foreach ($this->roleFeature as $temp) {
                $roleFeature = new RoleFeature;
                $roleFeature->id = $this->generator->ver1();
                $roleFeature->tenant_id = $this->tenant_id;
                $roleFeature->role_id = $input->id;
                $roleFeature->feature_id = $temp['feature_id'];
                $roleFeature->canCreate = $temp['canCreate'];
                $roleFeature->canRead = $temp['canRead'];
                $roleFeature->canUpdate = $temp['canUpdate'];
                $roleFeature->canDelete = $temp['canDelete'];

                $roleFeatureRepo = new RoleFeatureRepository\Insert($roleFeature);
                $roleFeatureRepo->Execute();
            }

            DB::commit();

            $res['message'] = "Success";
            $res['result'] = true;

            return $res;
        } catch (Exception $ex) {

            DB::rollback();

            $res['message'] = "Failed in bussiness logic";
            $res['result'] = false;

            return response()->json($ex);
        }
    }
}
