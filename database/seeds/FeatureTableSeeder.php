<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('feature')->insert(
            [
                'plugin_id' => 1,
                'featureName' => "feature.Role",
                'urlPath' => '/role',
                'icon' => 'bx bx-sitemap',
                'updated_at' => null,
                'deleted_at' => null
            ]);

        DB::table('feature')->insert(
            [
                'plugin_id' => 2,
                'featureName' => "feature.Dashboard",
                'urlPath' => '/',
                'icon' => 'bx bx-home-circle',
                'updated_at' => null,
                'deleted_at' => null
            ]
        );

        DB::table('feature')->insert(
            [
                'plugin_id' => 1,
                'featureName' => "feature.User",
                'urlPath' => '/user',
                'icon' => 'bx bxs-user',
                'updated_at' => null,
                'deleted_at' => null
            ]
        );

        DB::table('feature')->insert(
            [
                'plugin_id' => 3,
                'featureName' => "feature.Brand",
                'urlPath' => '/brand',
                'icon' => 'bx bxs-cube-alt',
                'updated_at' => null,
                'deleted_at' => null
            ]
        );
    }
}
