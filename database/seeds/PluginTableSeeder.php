<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PluginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('plugin')->insert([
            'pluginName' => "plugin.Basic",
            'displayName' => "App Settings",
            'order' => 2,
            'icon' => 'bx bx-customize',
            'updated_at' => null,
            'deleted_at' => null
        ]);

        DB::table('plugin')->insert([
            'pluginName' => "plugin.Dashboard",
            'displayName' => "Dashboard",
            "order" => 1,
            'icon' => 'bx bx-home-circle',
            'updated_at' => null,
            'deleted_at' => null
        ]);

        DB::table('plugin')->insert([
            'pluginName' => "plugin.Master",
            'displayName' => "Master",
            "order" => 1,
            'icon' => 'bx bx-layer',
            'updated_at' => null,
            'deleted_at' => null
        ]);
    }
}
