<?php

namespace App\Http\Controllers;

use App\BussinessLogic\FeaturePerRole\FeaturePerRole as FeaturePerRoleFeaturePerRole;
use Illuminate\Http\Request;
use App\Role;
use App\RoleFeature;
use App\Repositories\RoleRepository;
use App\Repositories\RoleFeatureRepository;
use App\Repositories\TenantPluginRepository;
use Yajra\DataTables\DataTables;
use App\BussinessLogic\PluginBL\PluginAndRoleActiveTenant;
use App\BussinessLogic\PluginBL\FeatureInfo;
use App\BussinessLogic\PluginBL\FeaturePerRole;
use App\BussinessLogic\RoleBL;
use App\BussinessLogic\RoleBL\InsertRole;
use App\BussinessLogic\RoleBL\UpdateRole;
use Illuminate\Support\Facades\App;
use stdClass;
use Throwable;


class RoleController extends Controller
{

    protected $roleRepo;
    protected $tenantPluginRepo;
    protected $roleFeatureRepo;

    public function __construct()
    {
   
        $this->roleRepo = new RoleRepository;
        $this->tenantPluginRepo = new TenantPluginRepository;
        $this->roleFeatureRepo = new RoleFeatureRepository;
    }

    public function Index()
    {
        return View('role.index');
    }

    public function GetRole(Request $request)
    {

        if (!request()->ajax()) {
            return abort(404);
        }

        $pageSize = ($request->length) ? $request->length : 10;

        $input = new stdClass();

        $input->pageSize = $pageSize;
        $input->searchValue = $request->search['value'];
        $input->start = $request->start;
        $input->draws = $request->draw;


        return $this->roleRepo->FindDataTable($input);
    }

    public function Create()
    {
        return View('role.create');
    }

    public function Save(Request $data)
    {

        $res['message'] = "Failed";
        $res['result'] = false;

        try {

            //validation to Database
            if ($this->roleRepo->FindByCode($data->roleInfo['code']) != null) {
                $res['message'] = 'Code ' . $data->roleInfo['code'] . ' is already exist';
                $res['result'] = false;

                return response()->json($res);
            }

            $roleBL = new InsertRole($data->roleInfo, $data->roleFeature);

            $res = $roleBL->Save();

            return response()->json($res);
        } catch (Throwable $ex) {

            $res['message'] = "Failed";
            $res['result'] = false;

            return response()->json($res);
        }
    }


    public function Update(Request $data)
    {

        $res['message'] = "Failed";
        $res['result'] = false;

        try {

            //validation to Database
            $roleInfo = $this->roleRepo->FindByID($data->roleInfo['id']);

            if ($roleInfo != null) {

                $roleBL = new UpdateRole($data->roleInfo, $data->roleFeature);

                $res = $roleBL->Save();

                return response()->json($res);
            } else {
                $res['message'] = 'Error, Please contact admin.';
                $res['result'] = false;

                return response()->json($res);
            }
        } catch (Throwable $ex) {

            $res['message'] = "Failed";
            $res['result'] = false;

            return response()->json($res);
        }
    }

    public function Edit($id)
    {
        $model = $this->roleRepo->FindByID($id);

        if ($model == null) {
            return abort(404);
        }
        
        return View('role.edit', ['role' => $model]);
    }

    public function UpdateStatus($id)
    {
        $roleStatusRepo = new RoleRepository\Status($id);
        $roleStatusRepo->Change();
    }

    public function Delete($id)
    {
        $roleDelete = new RoleRepository\Delete($id);
        $roleDelete->Execute();
    }

    public function GetDataFeature(Request $request)
    {

        if (!request()->ajax()) {
            return abort(404);
        }

        $pluginBL = new PluginAndRoleActiveTenant(auth()->user()->tenant_id);

        $data = $pluginBL->Get();

        return $data;
    }

    public function GetFeature($id)
    {
        if (!request()->ajax()) {
            return abort(404);
        }

        $featureInfo = new FeatureInfo($id);
        $result = $featureInfo->Get();

        $result[0]->pluginName = trans($result[0]->pluginName);
        $result[0]->featureName = trans($result[0]->featureName);

        return $result;
    }

    public function GetFeaturePerRole($id)
    {
        $feature = new FeaturePerRole($id);
        $data = $feature->Get();
        
        return $data;
    }

    public function GetRoleDropdown(Request $req)
    {
        if(!request()->ajax()){
            return abort(404);
        }

        $roleRepo = new RoleRepository\RoleDropdown();
        $data = $roleRepo->Get();
        
        return $data;
    }
}
