<?php


namespace App\BussinessLogic\UserBL;

use Illuminate\Support\Facades\DB;
use stdClass;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use App\User;
use App\Tenant;

class GetUserDataTable
{
    protected $searchValue;
    protected $dataStart;
    protected $pageSize;
    protected $tenantID;
    protected $draw;

    public function __construct($param)
    {
        $this->searchValue = $param->searchValue;
        $this->pageSize = $param->pageSize;
        $this->dataStart = $param->start;
        $this->tenantID = auth()->user()->tenant_id;
        $this->draw = $param->draws;
    }

    public function Get()
    {
        $count_filter = 0;

        $data = User::with('tenant')->where('deleted_at', null)
                        ->get();

        $count_total = $data->count();

        $result = $data->skip($this->dataStart)->take($this->pageSize);

        if ($count_filter == 0) {
            $count_filter = $count_total;
        }

        return DataTables::of($result)
            ->with([
                "sEcho" => $this->draw,
                "iTotalRecords" => $count_total,
                "iTotalDisplayRecords" => $count_filter,
            ])
            ->make(true);
    }
}
