<?php

namespace App\BussinessLogic\RoleBL;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use stdClass;
use App\Role;
use App\RoleFeature;
use App\Repositories\RoleRepository;
use App\Repositories\RoleFeatureRepository;
use Exception;
use Throwable;
use App\Helper;
use App\Helper\GenerateUUID;
use Yajra\DataTables\Utilities\Helper as UtilitiesHelper;

class InsertRole
{
    protected $roleRepo;
    protected $roleFeatureRepo;
    protected $role;
    protected $roleFeature;
    protected $tenant_id;
    protected $generator;

    public function __construct($_role, $_roleFeature)
    {
        $this->role = $_role;
        $this->roleFeature = $_roleFeature;
        $this->roleRepo = new RoleRepository;
        $this->roleFeatureRepo = new RoleFeatureRepository;
        $this->tenant_id = auth()->user()->tenant_id;
        $this->generator = new GenerateUUID;
    }

    public function Save()
    {
        DB::beginTransaction();

        try {

            
            $input = new Role;
            $input->id = $this->generator->ver1();
            $input->name = $this->role['name'];
            $input->code = $this->role['code'];
            $input->tenant_id = $this->tenant_id;
            $input->isActive = true;
            $input->updated_at = null;

            $roleRepo = new RoleRepository\Insert($input);
            $headerId = $roleRepo->Execute();

            foreach ($this->roleFeature as $temp) {
                $roleFeature = new RoleFeature;
                $roleFeature->id = $this->generator->ver1();
                $roleFeature->tenant_id = $this->tenant_id;
                $roleFeature->role_id = $headerId;
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
        } catch (Throwable $ex) {

            DB::rollback();

            $res['message'] = "Failed";
            $res['result'] = false;

            return response()->json($ex);
        }
    }


}
