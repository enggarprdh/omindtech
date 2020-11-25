<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TenantPluginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dashboard
        DB::table('tenant_plugin')->insert([
            'id' => Uuid::uuid1()->toString(),
            'tenant_id' => 1,
            'plugin_id' => 1,
            'isActive' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);

        //App Settings
        DB::table('tenant_plugin')->insert([
            'id' => Uuid::uuid1()->toString(),
            'tenant_id' => 1,
            'plugin_id' => 2,
            'isActive' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);

        //Master
        DB::table('tenant_plugin')->insert([
            'id' => Uuid::uuid1()->toString(),
            'tenant_id' => 1,
            'plugin_id' => 3,
            'isActive' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);
    }
}
