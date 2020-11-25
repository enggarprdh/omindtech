<?php 


namespace App\BussinessLogic\PluginBL;

use Illuminate\Support\Facades\DB;
use stdClass;


class PluginAndRoleActiveTenant
{
    protected $tenantID;

    public function __construct($_tenantid)
    {
        $this->tenantID = $_tenantid;
    }

    public function Get()
    {
        $temp = [];
        $out = [];

        $data = DB::table('plugin as p')
            ->join('feature as f', 'p.ID', '=', 'f.plugin_id')
            ->join('tenant_plugin as tp', 'tp.plugin_id', '=', 'p.id')
            ->where('tp.tenant_id', $this->tenantID)
            ->where('tp.deleted_at', null)
            ->select('p.id as plugin_id', 'p.pluginName', 'f.id as feature_id', 'f.featureName')
            ->get();

        $dataJSON = json_decode($data, true);

        foreach ($dataJSON as $item) {
            $temp[$item['pluginName']][] = [
                'displayName' => $item['pluginName'],
                'plugin_id' => $item['plugin_id'],
                'feature_id' => $item['feature_id'],
                'featureName' => $item['featureName']
            ];
        }

        foreach ($temp as $item) {
            $obj = new stdClass();
            $obj->text = trans($item[0]['displayName']);

            foreach ($item as $dataVal) {
                $objItem = new stdClass();

                $objItem->id = $dataVal['feature_id'];
                $objItem->text = trans($dataVal['featureName']);

                $obj->children[] = $objItem;
            }
            $out[] = $obj;
        }

        return $out;
    }
}