<?php

namespace App\Repositories;

use App\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleRepository
{

    protected $role;

    public function __construct()
    {
        $this->role = DB::table('role');
    }

    public function FindPerPage($per_page, $tenant_id)
    {
        $result = $this->role->where('tenant_id', '=', $tenant_id)
            ->whereNull('deleted_at')
            ->orderBy('created_at')->paginate($per_page);

        return $result;
    }

    public function FindByID($id)
    {
        return $this->role->find($id);
    }

    public function Delete($id)
    {
        $this->role->where('id', $id)
            ->where('deleted_at', null)
            ->update([
                'deleted_at' => Carbon::now()
            ]);
    }

    public function FindDataTable($data)
    {
        $count_filter = 0;

        if ($data->searchValue == null && $data->searchValue == "") {
            $role = Role::where('tenant_id', auth()->user()->tenant_id)->orderBy('id')
                ->where('deleted_at', null);
        } else {
            $role = Role::where('tenant_id', auth()->user()->tenant_id)->orderBy('id')
                ->where('name', 'like', '%' . $data->searchValue . '%')
                ->where('deleted_at', null);
        }

        $count_total = $role->count();

        $dataResult = $role->skip($data->start)->take($data->pageSize);

        if ($count_filter == 0) {
            $count_filter = $count_total;
        }


        return DataTables::of($dataResult)
            ->with([
                "sEcho" => $data->draws,
                "iTotalRecords" => $count_total,
                "iTotalDisplayRecords" => $count_filter,
            ])
            ->make(true);
    }

    public function FindByCode($code)
    {

        $result = $this->role->where('code', $code)
            ->where('deleted_at', null)
            ->first();

        return $result;
    }
}
