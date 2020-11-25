<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RoleFeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dashboard
        DB::table('role_feature')->insert([
            'id' => Uuid::uuid1()->toString(),
            'tenant_id' => 1,
            'role_id' => 1,
            'feature_id' => 1,
            'canCreate' => true,
            'canRead' => true,
            'canUpdate' => true,
            'canDelete' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);
        
        //User
        DB::table('role_feature')->insert([
            'id' => Uuid::uuid1()->toString(),
            'tenant_id' => 1,
            'role_id' => 1,
            'feature_id' => 2,
            'canCreate' => true,
            'canRead' => true,
            'canUpdate' => true,
            'canDelete' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);

        //Role
        DB::table('role_feature')->insert([
            'id' => Uuid::uuid1()->toString(),
            'tenant_id' => 1,
            'role_id' => 1,
            "feature_id" => 3,
            'canCreate' => true,
            'canRead' => true,
            'canUpdate' => true,
            'canDelete' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);

        //Brand
        DB::table('role_feature')->insert([
            'id' => Uuid::uuid1()->toString(),
            'tenant_id' => 1,
            'role_id' => 1,
            "feature_id" => 4,
            'canCreate' => true,
            'canRead' => true,
            'canUpdate' => true,
            'canDelete' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);
    }
}
