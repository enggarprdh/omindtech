<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use App\BussinessLogic\UserBL;
use App\Repositories\UserRepository;
use App\Repositories\FeatureRepository;
use App\Repositories\RoleFeatureRepository;
use App\RoleFeature;
use App\User;

class UserController extends Controller
{
    protected $featureName = 'feature.User';
    public function Index()
    {
        $featureRepo = new FeatureRepository\FindByFeatureName($this->featureName);
        $feature = $featureRepo->Get();
        return view('user.index');
    }

    public function GetUser(Request $request)
    {
        
        if(!request()->ajax())
        {
            return abort(404);
        }

        $pageSize = ($request->length) ? $request->length : 10;

        $input = new stdClass();

        $input->pageSize = $pageSize;
        $input->searchValue = $request->search['value'];
        $input->start = $request->start;
        $input->draws = $request->draw;

        $userQuery = new UserBL\GetUserDataTable($input);
        $userTable = $userQuery->Get();

        return $userTable;
    }

    public function UpdateStatus($id)
    {
        $roleStatusRepo = new UserRepository\Status($id);
        $roleStatusRepo->Change();
    }

    public function Create()
    {
        return view('user.create');
    }

    public function Save(Request $request)
    {
        if(!request()->ajax())
        {
            return abort(404);
        }
        $message = "Something Went Wrong";
        $result = false;
        $userBL = new UserBL\InsertUser($request);
        $response=$userBL->Save();
        $message = $response->message;
        $result = $response->result;
        return response()->json([
            'response'=> $result,
            'message' => $message
        ]);
    }

    public function UploadAvatar(Request $request)
    {
        $request->file('file')->store('images');
    }
}
