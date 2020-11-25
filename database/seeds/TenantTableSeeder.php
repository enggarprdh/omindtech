<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tenant')->insert([
            'id' => '1',
            'tenantName' => "Easy Project",
            'isActive' => true,
            'updated_at' => null,
            'deleted_at' => null
        ]);
    }
}
